<?php
  
  namespace App\Models\Entity;

  /**
   *  @Entity  @Table(name="stages")
   **/
  Class Stage{

  	/**
  	 * @var int
  	 * @Id @Column(type="integer")
  	 * @GeneratedValue
  	 */
  	protected $id;

    /**
     * @var int <Chave de associaçaõ com o ticket>
     * @ManyToOne(targetEntity="Ticket")
     * @JoinColumn(name="ticket", nullable=false, referencedColumnName="id")
     */
    protected $ticket;

    /**
     * @var int <Codigo associado a outro sistema>
     * @timestemp @Column(type="datetime", nullable=false, options={"comment":"Data e hora da alteração do stage"})
     */
    protected $timestemp;

    /**
     * @var string <Assunto de abertura do chamado>
     * @obs @Column(type="string", nullable=true, options={"comment":"Observasão e anotações sobre o stage"})
     */
    public $obs;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    
    /**
     * @return int <Chave de associaçaõ com o ticket>
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param int <Chave de associaçaõ com o ticket> $ticket
     *
     * @return self
     */
    public function setTicket($ticket)
    {
        if(!$ticket && !is_string($ticket)){
          throw new \InvalidArgumentException("Stage ticket is required", 400);        
        } 

        $this->ticket = $ticket;

        return $this;
    }

    /**
     * @return int <Codigo associado a outro sistema>
     */
    public function getTimestemp()
    {
        return $this->timestemp;
    }

    /**
     * @param int <Codigo associado a outro sistema> $timestemp
     *
     * @return self
     */
    public function setTimestemp($timestemp)
    {
        if(!$timestemp && !is_string($timestemp)){
          throw new \InvalidArgumentException("Stage Datatime is required", 400);        
        } 

        $this->timestemp = $timestemp;

        return $this;
    }

    /**
     * @return string <Assunto de abertura do chamado>
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param string <Assunto de abertura do chamado> $obs
     *
     * @return self
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }


    /**
     * @return App\Models\Entity\Ticket Array <Retona array contendo os valores de todos atributos>
     */
    public function getValues() {
        return get_object_vars($this);
    }
    
}
