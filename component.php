<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Planilha component
 */
class PlanilhaComponent extends Component
{

    public function planilha($model) {
    	// Buscando os registros e pegando o total de registros
    	$this->Planilha = TableRegistry::get($model);
		$database = $this->Planilha->find();
		$dbNumberOfLines = $this->Planilha->find()->count(); 

		$header = ''; // variável para armazenar o cabeçalho do XLS
		$data = ''; // variável para armazenar os registros do XLS

		// Criando o cabeçalho do XLS
		foreach ($database as $users) {
		}

		foreach ($users->toArray() as $key => $value) {
			$header .= $key . "\t";
		}
		// Fim do cabeçalho do XLS

		// Criando o "corpo" do XLS
		$user = $database->toArray();

		for ($i=0; $i < $dbNumberOfLines; $i++) 
        {
        	$line = '';   	
        	$row = $user[$i];        	
        	foreach ($row->toArray() as $key => $value) 
        	{                                            
               if ((!isset($value)) OR ($value == "")) 
               {
                   $value = "\t";
               } else {
                  $value = str_replace('"', '""', $value);
                  $value = '"' . $value . '"' . "\t";
                                 }
               $line .= $value;
            }
            $data .= trim($line)."\n";       	
        } 

		$data = str_replace("\r","",$data);
		// Fim do "corpo" do XLS

		// Gerando o arquivo XLS
         if ($data == "") {
           $data = "\n(0) Records Found!\n";                        
         }
         else{
           $hoje=date("Y_m_j");              
           header("Content-type: application/x-msdownload");
           header("Content-Disposition: attachment; filename=$model.xls");
           header("Pragma: no-cache");
           header("Expires: 0");
           print "$header\n$data";
           exit();  
         }

    }

}