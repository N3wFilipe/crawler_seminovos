# crawler_seminovos

Aplicação para coletar informações de anúncios no Seminovos utilizando o microframework Lumen

# Dependências

- GuzzleHttp: Para capturar o html da rota do seminovos;
- DomCrawler: Utilizado para filtrar o html retornado e fazer a iteração do mesmo;
- CssSelector: Utilizado em conjunto com o DomCrawler facilitou a filtragem do html via seletores CSS;

# Rodando a aplicação

Essa aplicação foi desenvolvida em PHP utilizando o microframework lumen. Para rodar a aplicação é necessário ter o PHP (utilizei o xampp com a versão 7.2 do PHP) instalado. O composer foi utilizado para gerenciamento das dependências, por isso, para ver a aplicação funcionando é necessário a instalação do composer e após clonar o código da aplicação executar o comando composer install dentro da pasta da aplicação para instalação das dependências. Para incializar a aplicação é necessário o comando *php -S localhost:8000 -t public*. Utilizei o postman para fazer o consumo das rotas;

# Rotas

A aplicação possui três rotas acessíveis: / e /search e /searchad

## /
- Método: GET;
- Função: Testar a aplicação;
- Chamada: -
- Retorno: jSON.

## /search
- Método: POST;
- Função: retornar os anúncios saneados do seminovos;
- Chamada: {
            "vehicleType": "carro",
            "vehicleBrand": "honda",
            "vehicleModel": "civic",
            "initialYear": 2000,
            "finalYear": 2012,
            "initialPrice": 5000,
            "finalPrice": 50000
            }
- Retorno: jSON.

## /searchad
- Método: POST;
- Função: retornar o detalhamento de um anúncio específico do seminovos;
- Chamada: {
	        "url": "https://seminovos.com.br/honda-civic-lx-1.6-16v-4portas-2000--2682116"
            }
- Retorno: jSON.

# Observações
Desenvolvendo a aplicação ainda enxergo algumas implementações que podem ser feitas e que pretendo fazer nesse código para dá-lo mais robustez, dinâmica e perfomance. Algumas implementações que farei: 

- Adicionar Validator;
- Persistir os dados saneados em mongo;
- Paginar as respostas do seminovos para permitir que sejam capturados mais de 20 anúncios;
- Autenticação JWT (Afinal, o que é uma API sem autenticação?).

Já sei como fazer essas implementações (principalmente a relacionada à paginação). Apenas não tive muito tempo para fazê-las. Estou aberto a quaisquer feedbacks e espero que dê tudo certo! Foi divertido fazer essa tarefa!