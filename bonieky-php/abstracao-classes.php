<?php 

abstract class Animal {

	private $nome;
	private $idade;

	abstract protected function andar();

	public function setNome($n){
		$this->nome = $n;
	}

	public function getNome(){
		return $this->nome;
	}

}

class Cavalo extends Animal{
	private $quantidade_de_patas;
	private $tipo_de_pelo;

	public function andar(){

	}
}

$cavalo = new Cavalo();
$cavalo->setNome("Cavalo Teste");
echo "O meu cavaloe é: ".$cavalo->getNome();