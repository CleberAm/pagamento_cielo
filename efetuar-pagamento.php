<?php

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
die();
/*/


require 'vendor/autoload.php';

use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;

use Cielo\API30\Ecommerce\Request\CieloRequestException;


//Nome titular ou primeiro nome
$nome_titular = $_POST['nome_titular'];
//Numerodo cartão
$numeroCartao = $_POST['numero_cartao'];
//Ex: 02/2023
$vencimento = $_POST['mes_vencimento']."/".$_POST['ano_vencimento'];
//Ex: 123
$codSeguranca = $_POST['cvv_cart'];
//	Valor do curso
$valor_total_curso = $_POST['valor_curso_completo'];
// Segundo nome se existir
$segundoNome = '';
//Quantidade de parcelas
$qtd_parcelas = $_POST['qtd_parcelas'];
//Se Bandeira for visa seta a constante da cielo CreditCard::VISA se não seta a constante CreditCard::MASTERCARD
$bandeira  = ($_POST['valor_curso_completo'] == 'visa' ? CreditCard::VISA : CreditCard::MASTERCARD); 
//Id do curso
$id_curso = "1545";


// Cartão cielo exemplo   0000000000000001




// ...
// Configure o ambiente
$environment = $environment = Environment::sandbox();

// Configure seu merchant
//id e chave sandbox
$merchant = new Merchant('d44a8f08-a6f8-4ae3-a2f1-47d9766aa905', 'WWBFGAVVLPVDDIZGOFZDIXPWAFERMQBHZDBMCFKP');

// Crie uma instância de Sale informando o ID do pedido na loja
$sale = new Sale($id_curso);

// Crie uma instância de Customer informando o nome do cliente
$customer = $sale->customer($nome_titular . ' ' . $segundoNome);

// Crie uma instância de Payment informando o valor do pagamento
$payment = $sale->payment((int) $valor_total_curso . '00' );

// Captura de forma automática
$payment->setCapture(1);

// Crie uma instância de Credit Card utilizando os dados de teste
// esses dados estão disponíveis no manual de integração
// 1°param: Código Segurança
// 2°param: Bandeira
// 3°param: Validade
// 4°param: Número Cartão
// 5°param: Nome cliente
$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
        ->creditCard($codSeguranca, CreditCard::VISA)
        ->setExpirationDate($vencimento)
        ->setCardNumber($numeroCartao)
        ->setHolder($nome_titular . ' ' . $segundoNome);
		$payment->setInstallments( $qtd_parcelas ); // Qtd Parcelas

// Crie o pagamento na Cielo
try {
    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
	//1°param: Ambiente SandBox ou Produção - configurado acima
	//2°param: Id e Chave - configurado acima
    $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

    // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
    // dados retornados pela Cielo
    $paymentId = $sale->getPayment()->getPaymentId();
	
	/*
	// Exibe status da transação
	echo $sale->getPayment()->getStatus();
	echo "-";
	// Exibe código de rotorno
	echo $sale->getPayment()->getReturnCode();
	echo "<pre>";
	// Printa o objeto na tela
	print_r($sale->getPayment());
	die();
	*/
	
	
	
	if($sale->getPayment()->getStatus() == 2){
		//header('Location: retorno.php?cod=0&TID' . $sale->getPayment()->getTid());
		echo "Sucesso! " . " Status " . $sale->getPayment()->getStatus() . " TID ". $sale->getPayment()->getTid();
	}else{
		//header('Location: retorno.php?cod=1&status' . $sale->getPayment()->status()."&erro".$sale->getPayment()->getReturnCode());
		echo "Erro " . $sale->getPayment()->getStatus()."&erro".$sale->getPayment()->getReturnCode();
	}
	

    // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
    $sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, 15700, 0);

    // E também podemos fazer seu cancelamento, se for o caso
    $sale = (new CieloEcommerce($merchant, $environment))->cancelSale($paymentId, 15700);
} catch (CieloRequestException $e) {
    // Em caso de erros de integração, podemos tratar o erro aqui.
    // os códigos de erro estão todos disponíveis no manual de integração.
    $error = $e->getCieloError();
}