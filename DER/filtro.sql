-- FILTRO no SQL
-- FILTRO com todos os usuarios que tiverem a letra o
select nome_usuario, data_cadastro
	from tb_usuario
where nome_usuario like '%o%';

-- FILTRO com todos os usuarios que tiverem a letra c
select nome_usuario, data_cadastro
	from tb_usuario
where nome_usuario like '%c%';

-- FILTRO com todos os usuarios que tiverem a letra r
select nome_usuario, data_cadastro
	from tb_usuario
where nome_usuario like '%r%';

-- Filtro de Datas
select nome_usuario, data_cadastro
	from tb_usuario
where data_cadastro between '2021-04-08' and '2021-04-16';

-- Filtro de Dados de Usuario
select banco_conta, agencia_conta, saldo_conta
	from tb_conta
where id_usuario = 1;

select banco_conta, agencia_conta, saldo_conta
	from tb_conta
where id_usuario = 2;

-- Filtro do Tipo de Movimento realizado
select tipo_movimento,
		data_movimento,
        valor_movimento,
        nome_categoria,
        nome_empresa,
        nome_usuario,
        banco_conta
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.tipo_movimento = 1;
    
select tipo_movimento,
		data_movimento,
        valor_movimento,
        nome_categoria,
        nome_empresa,
        nome_usuario,
        banco_conta
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.tipo_movimento = 2;

-- Y maiusculo, retorna os 4 digitou do ano
-- yminusculo, retorna apenas 2 digitos do ano
-- Comando SQL as significa dar um APELIDO para algum iten dos codigos    
select tipo_movimento,
		date_format(data_movimento, "%d/%m/%Y") as data_movimento,
        valor_movimento,
        nome_categoria,
        nome_empresa,
        nome_usuario,
        banco_conta,
        obs_movimento
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.obs_movimento is not null;
    
select tipo_movimento,
		data_movimento,
        valor_movimento,
        nome_categoria,
        nome_empresa,
        nome_usuario,
        banco_conta
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.tipo_movimento = 2
    and tb_movimento.valor_movimento > 50;
    
select tipo_movimento,
		data_movimento,
        valor_movimento,
        nome_categoria,
        nome_empresa,
        nome_usuario,
        banco_conta
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.id_usuario = 1;
    
-- Comando SQL sum soma os dados de tabelas
-- Comando SQL as da um apelido para algum item
select sum(valor_movimento) as Total
	from tb_movimento
    where tipo_movimento = 2;
    
select sum(valor_movimento) as Total
	from tb_movimento
    where tipo_movimento = 2
    and id_usuario = 2;