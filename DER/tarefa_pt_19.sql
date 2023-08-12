-- Utilizando o comando SQl inner join
-- Exer 1
select nome_usuario, nome_categoria
	from tb_usuario
inner join tb_categoria
	on tb_usuario.id_usuario = tb_categoria.id_categoria;

-- Exer 2    
select nome_usuario, nome_empresa, telefone_empresa, endereco_empresa
	from tb_usuario
inner join tb_empresa
	on tb_usuario.id_usuario = tb_empresa.id_empresa;
    
-- Exer 3    
select nome_usuario, email_usuario, banco_conta, saldo_conta, numero_conta
	from tb_usuario
inner join tb_conta
	on tb_usuario.id_usuario = tb_conta.id_conta;    

-- Exer 4    
select data_movimento, tipo_movimento, valor_movimento, nome_usuario
	from tb_movimento
inner join tb_usuario
	on tb_movimento.id_movimento = tb_usuario.id_usuario;    

-- Exer 5    
select data_movimento, tipo_movimento, valor_movimento, nome_usuario, nome_categoria
	from tb_movimento
inner join tb_usuario
	on tb_movimento.id_movimento = tb_usuario.id_usuario
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_movimento;
    
-- Exer 6
select nome_categoria, nome_empresa, nome_usuario, email_usuario, data_movimento, valor_movimento    
	from tb_categoria
inner join tb_usuario
	on tb_categoria.id_categoria = tb_usuario.id_usuario
inner join tb_empresa
	on tb_empresa.id_empresa = tb_usuario.id_usuario
inner join tb_movimento
	on tb_movimento.id_movimento = tb_usuario.id_usuario;
    
-- Exer 7
select banco_conta, numero_conta, nome_categoria, nome_empresa, nome_usuario, data_movimento, valor_movimento
	from tb_conta
inner join tb_usuario
	on tb_conta.id_conta = tb_usuario.id_usuario
inner join tb_categoria
	on tb_categoria.id_categoria = tb_usuario.id_usuario
inner join tb_empresa
	on tb_empresa.id_empresa = tb_usuario.id_usuario
inner join tb_movimento
	on tb_movimento.id_movimento = tb_usuario.id_usuario;
    
-- Utilizando o comando SQl where (Filtro)
-- Exer 1
select nome_usuario, nome_categoria
	from tb_usuario
inner join tb_categoria
	on tb_usuario.id_usuario = tb_categoria.id_categoria
where nome_usuario like '%a%';

-- Exer 2
select nome_usuario, nome_categoria
	from tb_categoria
inner join tb_usuario
	on tb_categoria.id_usuario = tb_usuario.id_usuario
    where tb_categoria.id_usuario = 1;
    
-- Exer 3
select nome_categoria, nome_empresa, nome_usuario, data_movimento, valor_movimento, tipo_movimento
	from tb_movimento
inner join tb_usuario
	on tb_movimento.id_usuario = tb_usuario.id_usuario   
inner join tb_categoria
    on tb_movimento.id_categoria = tb_categoria.id_categoria
inner join tb_empresa
    on tb_movimento.id_empresa = tb_empresa.id_empresa
    -- where tb_movimento.tipo_movimento in (1, 2);
    where tb_movimento.tipo_movimento = 1;
    
-- Exer 4
select banco_conta, numero_conta, nome_categoria, nome_empresa, nome_usuario, tipo_movimento, data_movimento, valor_movimento
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.tipo_movimento = 1
    and tb_movimento.id_usuario in (1, 2);
    
-- Exer 5
select banco_conta, numero_conta, nome_categoria, nome_empresa, nome_usuario, tipo_movimento, data_movimento, valor_movimento
	from tb_movimento
inner join tb_categoria
	on tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.tipo_movimento in (1, 2)
    and data_movimento between '2021-01-01' and  '2021-04-20'
        -- and tb_movimento.id_usuario = 1;