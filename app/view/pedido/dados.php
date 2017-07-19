<?php include_once(VIEWS.'layout/header.php'); ?>
<h1>Pedido #<?php echo $data->getId() ?></h1>
<table class="data">
	<caption>Dados do pedido</caption>
	<tr>
		<th>Cod</th>
		<td><?php echo $data->getId() ?></td>
	</tr>
	<tr>
		<th>Cliente</th>
		<td><?php echo $data->cliente()->getNome() ?></td>
	</tr>
	<tr>
		<th>Data</th>
		<td><?php echo $data->getDtPedido() ?></td>
	</tr>
</table>

<table class="list">
	<caption>Lista de produtos do pedido</caption>
	<tr>
		<th>Produto</th>
		<th width="150">Valor</th>
		<th width="150">Qtd</th>
		<th width="150">Total</th>
	</tr>
	<?php foreach($data->itens() as $item){ ?>
		<tr>
			<td><?php echo $item->produto()->getNome()?></td>
			<td><?php echo number_format($item->getPreco(),2, ',', '.')?></td>
			<td><?php echo $item->getQtd()?></td>
			<td><?php echo number_format($item->getTotal(),2, ',', '.')?></td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="3">Total</td>
		<td><?php echo number_format($data->getTotalPreco() ,2, ',', '.')?></td>
	</tr>
</table>


<table class="list">
	<caption>Total de embalagens para enviar um volume de <?php echo $data->getTotalVolume() ?></caption>
	<tr>
		<th>Nome</th>
		<th width="150">volume</th>
		<th width="150">qtd</th>
		<th width="150">preco</th>
	</tr>
	<?php foreach($data->getTotalEmbalagens() as $embalagem){ ?>
		<tr>
			<td><?php echo $embalagem->getNome()?></td>
			<td><?php echo $embalagem->getVolume()?></td>
			<td><?php echo $embalagem->getQtd()?></td>
			<td><?php echo number_format($embalagem->getPreco()*$embalagem->getQtd(),2, ',', '.')?></td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="3">Total</td>
		<td><?php echo number_format($data->getTotalVolumePreco(),2, ',', '.') ?></td>
	</tr>
</table>
<?php include_once(VIEWS.'layout/footer.php'); ?>
