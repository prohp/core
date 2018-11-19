<?php
namespace app\common\port\cli\controllers;

use app\common\console\Controller;
use app\common\workflow\WorkflowManagerInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;
use yii\helpers\FileHelper;

/**
 * Class PrintWorkflowController
 * 
 *
 * @author Dzhamal Tayibov
 */
class PrintWorkflowController extends Controller
{
    /**
     * @var WorkflowManagerInterface
     */
    public $workflowManager;

    public function __construct($id, $module, WorkflowManagerInterface $workflowManager, array $config = [])
    {
        $this->workflowManager = $workflowManager;
        parent::__construct($id, $module, $config);
    }

    public function actionPrint($workflowId)
    {
        $definition = $this->workflowManager->definitionFactory($workflowId);
        if (!isset($definition)) {
            return null;
        }
        $dumper = new GraphvizDumper();
        $dotRaw = $dumper->dump($definition);
        $pathDir = \Yii::getAlias('@runtime/temp');
        if (!is_dir($pathDir)) {
            FileHelper::createDirectory($pathDir, 0777);
        }
        $pathImage = $pathDir . DIRECTORY_SEPARATOR . $workflowId . '-workflow.png';
        $process = new Process('dot -Tpng -o ' . $pathImage);
        $process->setInput($dotRaw);
        $process->run();
        echo $pathImage;
    }
}
