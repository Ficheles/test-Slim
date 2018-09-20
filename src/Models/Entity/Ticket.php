<?php
  
  namespace App\Models\Entity;

  /**
   *  @Entity  @Table(name="tickets")
   **/
  Class Ticket{

  	/**
  	 * @var int
  	 * @Id @Column(type="integer")
  	 * @GeneratedValue
  	 */
  	protected $id;

    /**
     * @var int <Campo para codigo do chamado no JIRA>
     * @cod @Column(type="integer")
     */
    protected $cod;

    /**
     * @var int <Campo quando o chamado atual tem outro codigo associado>
     * @old @Column(type="integer")
     */
    protected $old;

    /**
     * @var string <Nome do programa ao qual o chamado esta registrado>
     * @Column(type="string")
     */
    protected $program;

    /**
     * @var string <Nome do programa de referencia, para a abertura do chamado>
     * @Column(type="string")
     */
    protected $name_program;

    /**
     * @var string <Principal programa relacionado ao processo, base para validação>
     * @Column(type="string")
     */
    protected $template

    /**
     * @var string <Area de negocios ou departmento>
     * @Column(type="string")
     */
    protected $department;

    /**
     * @var string <Assunto de abertura do chamado>
     * @Column(type="string")
     */
    public $subject;


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
     * @return int <Campo para codigo do chamado no JIRA>
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * @param App\Models\Entity\Ticket int <Campo para codigo do chamado no JIRA> $cod
     *
     * @return self
     */
    public function setCod($cod)
    {
        
        if(!$cod && !is_string($cod)){
          throw new \InvalidArgumentException("Ticket code is required", 400);        
        } 

        $this->cod = $cod;

        return $this;
    }

    /**
     * @return App\Models\Entity\Ticket int <Campo quando o chamado atual tem outro codigo associado>
     */
    public function getOld()
    {
        return $this->old;
    }

    /**
     * @param App\Models\Entity\Ticketint <Campo quando o chamado atual tem outro codigo associado> $old
     *
     * @return self
     */
    public function setOld($old)
    {
        $this->old = $old;

        return $this;
    }

    /**
     * @return App\Models\Entity\Ticket string <Nome do programa ao qual o chamado esta registrado>
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @param App\Models\Entity\Ticket string <Nome do programa ao qual o chamado esta registrado> $program
     *
     * @return self
     */
    public function setProgram($program)
    {
        if(!$program && !is_string($program)){
          throw new \InvalidArgumentException("Ticket program is required", 400);        
        } 

        $this->program = $program;

        return $this;
    }

    /**
     * @return App\Models\Entity\Ticket string <Nome do programa de referencia, para a abertura do chamado>
     */
    public function getNameProgram()
    {
        return $this->name_program;
    }

    /**
     * @param App\Models\Entity\Ticket string <Nome do programa de referencia, para a abertura do chamado> $name_program
     *
     * @return self
     */
    public function setNameProgram($name_program)
    {
        if(!$name_program && !is_string($name_program)){
          throw new \InvalidArgumentException("Ticket name_program is required", 400);        
        }
        $this->name_program = $name_program;

        return $this;
    }

    /**
     * @return App\Models\Entity\Ticket string <Area de negocios ou departmento>
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param App\Models\Entity\Ticket string <Area de negocios ou departmento> $department
     *
     * @return self
     */
    public function setDepartment($department)
    {
        if(!$department && !is_string($department)){
          throw new \InvalidArgumentException("Ticket department is required", 400);        
        }

        $this->department = $department;

        return $this;
    }

    /**
     * @return App\Models\Entity\Ticket string <Assunto de abertura do chamado>
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param App\Models\Entity\Ticket string <Assunto de abertura do chamado> $subject
     *
     * @return self
     */
    public function setSubject($subject)
    {
        if(!$subject && !is_string($subject)){
          throw new \InvalidArgumentException("Ticket subject is required", 400);        
        }  

        $this->subject = $subject;

        return $this;
    }

    /**
     * @return App\Models\Entity\Ticket Array <Retona array contendo os valores de todos atributos>
     */
    public function getValues() {
        return get_object_vars($this);
    }
}