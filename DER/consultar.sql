-- COMANDO PARA CONSULTAR, SELECIONAR (READ)
-- Consultar Tabela Usuario
select * from tb_usuario;

-- Consultar Tabela Categoria
select * from tb_categoria;

-- Consultar Tabela Empresa
select * from tb_empresa;

-- Consultar Tabela Conta
select * from tb_conta;

-- Consultar tb_movimento
select * from tb_movimento;

-- Verifica a contagem, de quantos emails com a sintaxe definida, existe cadastrado na Tabela Usuario
-- Comando count: Ele que realiza a contagem de acordo as coordenadas passadas para o SQL
select count(email_usuario) from tb_usuario where email_usuario = 'baronir@exemplo.com';

-- Mesmo exemplo  anterior, porém um NOME/APELIDO foi dado a coluna email_usuario
select count(email_usuario) as contar from tb_usuario where email_usuario = 'baronir@exemplo.com';

-- Consultar apenas as Categorias da Tabela Categotia
select nome_categoria from tb_categoria;

-- Consultar as Categorias e os seus respe
select nome_categoria, id_usuario from tb_categoria;

-- Inner Join possibilita Selecionar dados em mais de 1 Tabela em uma unica Operação
select nome_categoria, nome_usuario
	from tb_categoria
inner join tb_usuario
	on tb_categoria.id_usuario = tb_usuario.id_usuario;
    
-- Inner Join possibilita Selecionar dados em mais de 1 Tabela em uma unica Operação
-- Gerando Relatórios
-- Uma forma de Selecionar todas as Colunas das duas tabelas especificadas
select * from tb_categoria
	inner join tb_usuario
		on tb_categoria.id_usuario = tb_usuario.id_usuario;
    
select nome_categoria, email_usuario, nome_usuario
	from tb_categoria
inner join tb_usuario
	on tb_categoria.id_usuario = tb_usuario.id_usuario;
    
select nome_usuario, nome_empresa
	from tb_empresa
inner join tb_usuario
	on tb_empresa.id_usuario = tb_usuario.id_usuario;
    
select banco_conta, agencia_conta, numero_conta, saldo_conta, nome_usuario
	from tb_conta
inner join tb_usuario
	on tb_conta.id_usuario = tb_usuario.id_usuario;
    
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
	on tb_conta.id_conta = tb_movimento.id_conta;

    
select data_movimento,
		valor_movimento,
		nome_categoria,
        nome_empresa,
        tipo_movimento,
        nome_usuario
	from tb_movimento as mo
		inner join tb_categoria as ca
			on ca.id_categoria = mo.id_categoria
		inner join tb_empresa as em
			on em.id_empresa = mo.id_empresa
		inner join tb_usuario as us
			on us.id_usuario = mo.id_usuario
		where mo.data_movimento between '2021-04-21' and '2021-06-10';
        
-- Este comando, realiza a soma de valores em Colunas Diferentea da Tabela
select sum(valor_movimento) as Total from tb_movimento where tipo_movimento = 2;