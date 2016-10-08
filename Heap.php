<?php 

/**
* Heap struct
*/
class Heap{

    private $heap;

    function __construct($heap = array() ){
        $this->heap = $heap;
    }

    public static function pai($i){
        return ($i-1) / 2;
    }

    public static function filhoEsq($i){
        return ($i*2) + 1;
    }

    public static function filhoDir($i){
        return ($i*2) + 2;
    }

    public static function get($i){
        return $this->heap[$i];
    }

    private function reposicionaSubindo($no){
        $pai = Heap::pai($no);
        while ($pai >= 0) {

            if ($this->heap[$no] < $this->heap[$pai]) {
                // print($this->heap[$no]." menor que seu pai ".$this->heap[$pai]." trocando...\n");
                $aux = $this->heap[$pai];
                $this->heap[$pai] = $this->heap[$no];
                $this->heap[$no] = $aux;
                $no = $pai;
                $pai = Heap::pai($no);
            } else { break; }
        }
    }

    private function reposicionaDescendo($no = 0){
        // echo "Reposicionando...\n";
        while ( $no < count($this->heap) ) {
            
            $esq = Heap::filhoEsq($no);
            $dir = Heap::filhoDir($no);
            $menor = $no;

            // echo "No esq: ".$esq.PHP_EOL;
            // echo "No dir: ".$dir.PHP_EOL;
            // echo "No menor: ".$menor.PHP_EOL;

            if ( $this->heap[$esq] < $this->heap[$menor] && $esq < count($this->heap)) {
                // echo $this->heap[$esq]." menor que ".$this->heap[$menor]." trocando...\n";
                $menor = $esq;
            }
            if ( $this->heap[$dir] < $this->heap[$menor] && $esq < count($this->heap)) {
                // echo $this->heap[$dir]." menor que ".$this->heap[$menor]." trocando...\n";
                $menor = $dir;
            }
            if ($no == $menor) { break; }

            $aux = $this->heap[$no];
            $this->heap[$no] = $this->heap[$menor];
            $this->heap[$menor] = $aux;
            unset($aux);

            $no = $menor;

        }

    }

    public function insere($val){
        // echo "Inserindo ".$val."...".PHP_EOL;
        $this->heap[] = $val;
        Heap::reposicionaSubindo(count($this->heap)-1);
    }

    public function remove(){
        // echo "Removendo no ".$this->heap[0].PHP_EOL;
        $this->heap[0] = end($this->heap);
        array_pop($this->heap);
        Heap::reposicionaDescendo(0);
    }

    public function print(){
        $H = $this->heap;
        foreach ($H as $h) {
            print($h . " ");
        }
        echo PHP_EOL;
        // var_dump($this->heap);
    }

    public function printEmOrdem($no = 0){
        if ($this->heap[Heap::filhoDir($no)]) {
            $this->printEmOrdem( Heap::filhoEsq($no) );
        }
        echo $this->heap[$no]." ";
        if ($this->heap[Heap::filhoDir($no)]) {
            $this->printEmOrdem( Heap::filhoDir($no) );
        }
    }

    public function printPreOrdem($no = 0){
        echo $this->heap[$no]." ";
        if ($this->heap[Heap::filhoDir($no)]) {
            $this->printEmOrdem( Heap::filhoEsq($no) );
        }
        if ($this->heap[Heap::filhoDir($no)]) {
            $this->printEmOrdem( Heap::filhoDir($no) );
        }
    }

    public function printPosOrdem($no = 0){
        if ($this->heap[Heap::filhoDir($no)]) {
            $this->printEmOrdem( Heap::filhoEsq($no) );
        }
        if ($this->heap[Heap::filhoDir($no)]) {
            $this->printEmOrdem( Heap::filhoDir($no) );
        }
        echo $this->heap[$no]." ";
    }

    public function heapsort(){
        
    }


}


// funcoes extras
function br(){
    print(PHP_EOL);
}


$Heap = new Heap(array(4,5,7,46,35,11,12));

br();br();
// vamos testar

print("ESTRUTURA");
br();
$Heap->print();

br();br();

print("ESTRUTURA APOS ADICAO");
br();
$Heap->insere(9);
$Heap->print();

br();br();


print("ESTRUTURA APOS REMOCAO");
br();
$Heap->remove();
$Heap->print();

br();br();


print("PRINT PRE ORDEM");
br();
echo $Heap->printPreOrdem();
br();br();


print("PRINT EM ORDEM");
br();
echo $Heap->printEmOrdem();
br();br();


print("PRINT POS ORDEM");
br();
echo $Heap->printPosOrdem();
br();br();


?>