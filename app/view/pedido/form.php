<?php include_once(VIEWS.'layout/header.php'); ?>
<h1>Cadastro de Pedido</h1>

<?php if (isset($_GET['errors'])){ ?>
	<div class="erro">
	<?php foreach($_GET['errors'] as $erro) { ?>
		<?php echo $erro ?>
	<?php } ?>
	</div>
<?php } ?>
<form method="post" action="?modulo=pedido&acao=fecharPedido">
<table class="data">
	<caption>Dados do pedido</caption>
	<tr>
		<th>Cliente</th>
		<td>
		<select name="data[cliente][id]">
			<?php foreach($data['clientes'] as $cliente) { ?>		
			<option value="<?php echo $cliente->getId()?>"><?php echo $cliente->getNome()?></option>
			<?php } ?>
		</select>
		</td>
	</tr>
	<tr>
		<th>Data Pedido</th>
		<td>
			<input type="text" name="data[pedido][dt_pedido]" value="<?php echo isset($_GET['dt_pedido'])?$_GET['dt_pedido']:$data['pedido']['dt_pedido'] ?>">	
		</td>
	</tr>
</table>
<table class="list">
	<caption>Lista de produtos</caption>
	<tr>
		<th>Produto</th>
		<th>Valor</th>
		<th>Qtd</th>
	</tr>
	<?php foreach($data['produtos'] as $produto) { ?>
	<tr>
		<td>
			<input type="hidden" name="data[produtos][<?php echo $produto->getId() ?>][id]" value="<?php echo $produto->getId() ?>">
			<input type="hidden" name="data[produtos][<?php echo $produto->getId() ?>][volume]" value="<?php echo $produto->getVolume() ?>">
			<input type="hidden" name="data[produtos][<?php echo $produto->getId() ?>][preco]" value="<?php echo $produto->getPreco() ?>">
			<?php echo $produto->getNome() ?>
		</td>
		<td>
			<?php echo $produto->getPreco() ?>
		</td>
		<td>
			<input type="text" name="data[produtos][<?php echo $produto->getId() ?>][qtd]" value="<?php echo isset($_GET['produto'][$produto->getId()]['qtd'])?$_GET['produto'][$produto->getId()]['qtd']:'' ?>">
		</td>
	</tr>
	<?php } ?>
</table>
<hr>
<center>
	<button type="submit">Fechar Pedido</button>
</center>
</form>


<?php include_once(VIEWS.'layout/footer.php'); ?>
