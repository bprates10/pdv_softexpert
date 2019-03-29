# Aplicação PDV e cadastro de estoque
PDV Softexpert é uma ferramenta simples para cadastro de mercadorias, categorias e impostos.
Surgiu da necessidade de criar um projeto para a empresa solicitante, para fins avaliativos e sem valor comercial.
A ferramenta é poderosa, porém não deve ser utilizada no mundo real, servindo apenas para fins didáticos.

Sobre a ferramenta (módulo Cadastros):
- Possibilita o cadastro de produtos;
- Possibilita a cadastro de categorias;
- Possibilita a cadastro de impostos;

Sobre a ferramenta (módulo PDV):
- Pemrite a venda de UM a N produtos por venda;
- Permite editar a quantidade dos produtos por venda;
- Calcula automaticamente o valor de cada item multiplicado pela quantidade total adquirida na venda;
- Calcula automaticamente o valor do imposto pago em cada item;
- Calcula automaticamente o valor total da venda, em R$;
- Calcula automaticamente o valor total dos impostos da venda, em R$.

Funcionalidades a serem implementadas:
- (em desenvolvimento) Exclusão e edição de produtos cadastrados;
- (em desenvolvimento) Exclusão e edição de categorias;
- (em desenvolvimento) Exclusão e edição de impostos;
- (em desenvolvimento) Finalização da venda, emitindo o cupom fiscal.
- Melhorias na base de dados (PostgreSQL).

Sobre a codificação:
- Utiliza pattern DAO, mantendo bem definido a divisão entre regra de negócio e regra de acesso ao banco, permitindo reutilização classes;
- Utiliza pattern MVC, mantendo bem definido as responsabilidades de cada camada sobre a aplicação;
- Utiliza pattern Singleton, permitindo apenas uma instância de classe para otimizar as requisições da aplicação no banco de dados;
- Utiliza requisições assíncronas em Ajax para impedir que o conteúdo da página seja recarregado a cada nova solicitação.
- Utiliza uma classe responsável pelo roteamento, driblando a ausência de um framework ao mesmo tempo em que mantém o código simples, objetivo desde projeto.
- Utiliza um frame genérico e adaptável a cada requisição de módulo/menu.
- Utiliza banco de dados PostgreSQl versão 9.4.
