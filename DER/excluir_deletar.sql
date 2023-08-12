-- COMANDO PARA DELETAR UMA TABELA DO BANCO DE DADOS
drop table tb_usuario;

-- COMANDOS PARA EXCLUIR (DELETE)
delete from tb_usuario
	where id_usuario = 7;
    
delete from tb_categoria
	where id_categoria = 1;
    
delete from tb_empresa
	where id_empresa = 12;  
    
delete from tb_categoria 
	where id_categoria = 33;    
    
-- Deleter um Grupo de Linhas na Tabela
delete from tb_empresa 
	where id_empresa in (1, 2, 3);
    
delete from tb_movimento 
	where id_movimento in (13, 14, 15, 16, 17, 18, 19, 20, 21, 22); 
    
delete from tb_categoria 
	where id_categoria in (23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 34);    
    
delete from tb_empresa 
	where id_empresa in (13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29); 
    
delete from tb_conta 
	where id_conta in (21, 22, 23, 24); 
    