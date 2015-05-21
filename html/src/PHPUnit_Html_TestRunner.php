<?php
/** 
 * @Source https://github.com/nickturner/PHPUnit_Html
 */
class PHPUnit_Html_TestRunner extends PHPUnit_TextUI_TestRunner {


    static public function run($arguments = array()) {
        $_arguments = array(
            'tpldir' => null,                       /// template dir
            'test' => null,                         /// the test
            'testFile' => null,
            'coverageClover' => null,
            'coverageHtml' => null,                 /// codecoverage directory
            'filter' => null,                       
            'groups' => null,
            'excludeGroups' => null,
            'processInsolation' => null,
            'syntaxCheck' => false,
            'stopOnError' => false,
            'stopOnFailure' => false,
            'stopOnIncomplete' => false,
            'stopOnSkipped' => false,
            'noGlobalsBackup' => true,
            'staticBackup' => true,
            'bootstrap' => null,
            'configuration' => null,
            'noConfiguration' => false,
            'strict' => false
            );

        $printer = new PHPUnit_Html_Printer($arguments['tpldir']);

        try {

            $arguments = ($arguments ? array_merge($_arguments, array_intersect_key($arguments, $_arguments)) : $_arguments);

            $arguments['backupGlobals'] = !$arguments['noGlobalsBackup'];
            unset($arguments['noGlobalsBackup']);

            $arguments['backupStaticAttributes'] = !$arguments['staticBackup'];
            unset($arguments['staticBackup']);

            $arguments['useDefaultConfiguration'] = !$arguments['noConfiguration'];
            unset($arguments['noConfiguration']);

            if (isset($arguments['coverageHtml'])) {
                $arguments['reportDirectory'] = $arguments['coverageHtml'];
                unset($arguments['coverageHtml']);
            }

            if (!isset($arguments['test']) && !isset($arguments['testFile'])) {
                $arguments['test'] = getcwd();
            }
    
            $arguments['printer'] = $printer;
            $arguments['listeners'] = null ; //array(new PHPUnit_Util_DeprecatedFeature_Logger());

            if ($arguments['bootstrap']) {
                PHPUnit_Util_Fileloader::checkAndLoad($arguments['bootstrap'], $arguments['syntaxCheck']);
            }

            $runner = new PHPUnit_Html_TestRunner();
            $suite = $runner->getTest(
                $arguments['test'],
                $arguments['testFile'],
                $arguments['syntaxCheck']);
        
            unset($arguments['test']);
            unset($arguments['testFile']);
    
            $result = $runner->doRun($suite, $arguments);
            $arguments['printer']->printResult($result);

        } catch (Exception $e) {

            $printer->printAborted($e);

        }
    }
}

?>
