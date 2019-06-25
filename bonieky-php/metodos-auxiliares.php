<?php 

class Post {
	private $titulo;
	private $data;
	private $corpo;
	private $comentarios;

	private $qtComentarios;

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($t){
		if(is_string($t)){
			$this->titulo = $t;
		}
	}

	public function addComentario($msg){
		$this->comentarios[] = $msg;
		$this->contarComentarios();
	}
		public function getComentarios(){
			return $this->comentarios;
		}

	public function getQuantosComentarios(){
		// return count($this->comentarios);
		return $this->qtComentarios;
	}

	private function contarComentarios(){
		$this->qtComentarios = count($this->comentarios);
	}
} //fim da classe

$post = new Post();

$post->addComentario("Teste1");
$post->addComentario("Teste2");
$post->addComentario("Teste3");
$post->addComentario("Teste3");

echo "Quantidade de comentarios: ".$post->getQuantosComentarios();
// echo "Comentarios: ".$post->getComentarios();
echo "<br>Comentarios: ".implode(', ',$post->getComentarios()).".";

 