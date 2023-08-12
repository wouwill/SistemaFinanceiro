-- COMANDO PARA INSERIR
-- insert in to nome_da_tabela (colunas) values (valores)
-- Cadastro da Tabela Usuário
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Alisson Rocha','alissonrocha@gmail.com','ali321','2021-04-12');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Fernando Trindade','fer.trindade@gmail.com','F3Rn@ndo21','2021-04-12');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Alexandre','alexandre@gmail.com','3323','2021-04-13');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Ana Maria','anamaria@gmail.com','ana123','2021-04-02');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Carlos Junior','carlos_jr@gmail.com','jun2021@','2021-04-10');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Ana Julia','ana.julia@gmail.com','@na387','2021-04-05');

-- Cadastro da Tabela Categoria
insert into tb_categoria
(nome_categoria, id_usuario)
values
('Alimentação', 1);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Financiamento Carro', 5);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Internet', 2);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Luz/Energia', 1);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Cursos/Estudos', 1);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Aguá', 2);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Financiamento Casa', 2);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Escola Particular', 2);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Combustivél', 4);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Celular', 6);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Computador', 6);

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Tecnologia', 6);

-- Cadastro da Tabela Empresa
insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Burguer King', '(43) 3322-5566', 'Avenida Higienopolis', 1);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Londritchy', '(43) 3355-3536', 'Avenida das Aves', 6);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Garagem VeicularLD', '33254906', 'Avenida JK', 5);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Udemy', '080032156', 'Avenida São Paulo', 1);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Muffato', '33669985', 'Avenida Duque de Caxias', 5);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('MaxiEscola', '33669900', 'Avenida dos Estudantes', 2);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Distribuidora Bebum', '33661717', 'Avenida Etanol beer', 2);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Limpeza Home', '33990099', 'Avenida Bem Limpinho', 4);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Lanchonete Come Come', '99885533', 'Avenida Fat Boy', 4);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Bar Tequila', '33656447', 'Avenida Drinks', 1);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('IFoode', '33225599', 'Avenida Web Deliver', 1);

-- Cadastro da Tabela Conta
insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Santander', '36585', '447752-09', 4500.20, 1);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Itau', '7756', '56398-5', 12500.85, 5);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Sicredi', '718', '059687-9', 8750.55, 5);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Bradesco', '7198', '65879-2', 1300.25, 1);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Itau', '6548', '4879-6', 8000.05, 2);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Bradesco', '6540', '3907-6', 860.74, 2);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Sicoob', '98705', '40887-3', 23565.72, 4);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Sicredi', '32184', '65402-32', 6500, 4);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Itau', '31987', '4879-6', 6548.79, 6);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Santander', '64803', '4879-6', 2698.95, 6);
;
-- Cadastro da Tabela Movimento
insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_categoria, id_empresa, id_conta, id_usuario)
values
(1, '2021-06-06', 2500, null, 36, 30, 25, 1);

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_categoria, id_empresa, id_conta, id_usuario)
values
(1, '2021-06-06', 2500, null, 36, 30, 25, 1);