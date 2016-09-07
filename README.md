# Commercial_Control_System - Sistema_de_Controle_Comercial
It's a prototype program (for learning purposes) written in PHP, using Apache server and MySQL. It keeps under track all the sales, purchases, suppliers, employees and customers informations - É um programa de protótipo (para fins de aprendizagem) escrito em PHP, utilizando um servidor Apache e MySQL. Ele mantém sob controle todas as vendas, compras, fornecedores, funcionários e informações de clientes


This is a project I did for my College in Brazil as a avaliation work. So I decided to place it here. That way people can use it, and maybe improve it. It was done in PHP after I had learned that language for a semester in College. Despite of my focus be in network infraestructure, I've learned some programming stuff, which is great. I really love it!
I've done this in Linux and Windows and there are several ways to make it work. It can be installed separately: MySQL, Apache and PHP, or in order to make it easier, just download and install XAMPP: https://www.apachefriends.org. That's in case you're using Windows, for Linux the easiest one is WAMPSERVER http://www.wampserver.com/en/.

The authentication is not fully working, it just give an idea about how it could be to have a real security control. I created a user for tests and any employee that you create becomes a new user and the ID is the password:
User: "user"
Password: "12345"

So, for XAMPP, after install it, please do the following:
> Start on the XAMPP's control panel: Apache and MySQL
> In front of MySQL, Click on button "Admin" in order to add the database
> It's going to open a Web browser. On the left side click on "new", fill the field name "projeto1" and hit create button
> Go to "import" tab and hit "choose a file", select "projeto1.sql" that you got from Github and hit "execute". Sometimes it gives some errors, in case it happens, just do it again.
> Go to C:\xampp\htdocs, copy everything inside it, create a new folder (e.g. "docs"), and paste all the stuff you've had copied.
> Copy all php files and others files you got from Github (the php_files folder) and paste them in C:\xampp\htdocs

And you're all set! Now just open up a web browser and type "localhost" or 127.0.0.1
You can also check your IP address (from the server) and access it from any other computer from the same network, just by opening the Web browser and typing the IP address from the server.



Este é um projeto que eu fiz para a minha faculdade no Brasil como um trabalho a ser avaliado. Então eu decidi colocá-lo aqui. Dessa forma, as pessoas podem usá-lo, e talvez melhorá-lo. Foi feito em PHP após que eu ter aprendido essa linguagem por um semestre na faculdade. Apesar de o meu foco estar em infraestrutura de rede, eu aprendi alguns conceitos de programação, o que é ótimo. Eu realmente amo isso!
Eu fiz isso em Linux e Windows e há várias maneiras de fazê-lo funcionar. Ele pode ser instalado separadamente: MySQL, Apache e PHP, ou a fim de torná-lo mais fácil, basta baixar e instalar o XAMPP: https://www.apachefriends.org. Isso é no caso de você estar usando o Windows, para Linux o mais fácil é WAMPServer http://www.wampserver.com/en/.

A autenticação não é totalmente funcional, é apenas para dar uma idéia sobre como poderia ser um controle de segurança real. Eu criei um usuário para testes e qualquer funcionário que você cria torna-se um novo usuário e o ID (ou CPF no Brasil) é a senha:
Usuário: "user"
Password: "12345"

Assim, para o XAMPP, depois de realizar a instalação, por favor faça o seguinte:
> Iniciar no painel de controle do XAMPP: Apache e MySQL
> Na frente do MySQL, clique no botão "Admin", a fim de adicionar o banco de dados
> Vai abrir um navegador da Web. Clique no lado esquerdo em "nova", preencha o nome do campo "projeto1" e aperte o botão criar
> Vá para a aba "importação" e clique em "escolher um arquivo", selecione "projeto1.sql" que você obteve no Github e clique em "executar". Às vezes ele dá alguns erros, caso isso aconteça, basta repetir o processo de importação.
> Vá para C:\xampp\htdocs, copie tudo dentro dele, crie uma nova pasta (por exemplo, "docs"), e cole todas as coisas que você tinha copiado.
> Copie todos os arquivos PHP e demais que você obteve de Github (a pasta php_files) e cole-os em C:\xampp\htdocs

E está tudo pronto! Agora basta abrir um navegador e digitar "localhost" ou 127.0.0.1
Você também pode verificar o seu endereço IP (do servidor) e acessá-lo de qualquer outro computador da mesma rede, apenas abrindo o navegador da Web e digitando o endereço IP do servidor.
