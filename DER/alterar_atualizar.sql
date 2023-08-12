-- COMANDO PARA ALTERAR, ATUALIZAR (UPDATE)

-- UPDATE Tabela Usuário
update tb_usuario
	set email_usuario = 'alisson.f.rocha@hotmail.com',
		senha_usuario = '@l!$$0N321'
	where id_usuario = 1;

-- UPDATE Tabela Empresa
update tb_empresa
	set telefone_empresa = '33225599'
	where id_usuario = 1;
    
update tb_empresa
	set telefone_empresa = '4333254890'
	where id_usuario = 1;
       
update tb_empresa
	set telefone_empresa = '33553536'
	where id_empresa = 11;

-- UPDATE Tabela Movimento
update tb_movimento
	set obs_movimento = 'Taxa paga pela Internet e TV'
	where id_movimento = 4;  