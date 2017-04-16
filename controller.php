public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Planilha');
    }
    

public function gerarPlanilha()
    {
        $this->Planilha->planilha('Users');
    }