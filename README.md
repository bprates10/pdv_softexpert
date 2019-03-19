# Aplicação PDV e cadastro de estoque
PDV Softexpert é uma ferramenta simples para cadastro de mercadorias, categorias e impostos.
Surgiu da necessidade de criar um projeto para a empresa solicitante, para fins avaliativos e sem valor comercial.
A ferramenta é poderosa, porém não deve ser utilizada no mundo real, servindo apenas para fins didáticos.

Sobre a ferramenta:
- (em desenvolvimento) Possibilita o cadastro, exclusão e edição de produtos;
- (em desenvolvimento) Possibilita a cadastro, exclusão e edição de categorias;
- (em desenvolvimento) Possibilita a cadastro, exclusão e edição de impostos;

A ferramenta possui um módulo de PDV. A tela PDV permite:
- (em desenvolvimento) A venda de UM a N produtos por venda;
- (em desenvolvimento) A quantidade dos produtos por venda;
- (em desenvolvimento) O valor de cada item multiplicado pela quantidade total adquirida na venda;
- (em desenvolvimento) O valor do imposto pago em cada item;
- (em desenvolvimento) O valor total da venda, em R$;
- (em desenvolvimento) O valor total dos impostos da venda, em R$.

Sobre a codificação:
- Utiliza pattern DAO, mantendo bem definido a divisão entre regra de negócio e regra de acesso ao banco, permitindo reutilização classes;
- Utiliza pattern MVC, mantendo bem definido as responsabilidades de cada camada sobre a aplicação;
- Utiliza pattern Singleton, permitindo apenas uma instância de classe para otimizar as requisições da aplicação no banco de dados;
- Utiliza requisições assíncronas em Ajax para impedir que o conteúdo da página seja recarregado a cada nova solicitação.
- Utiliza uma classe responsável pelo roteamento, driblando a ausência de um framework ao mesmo tempo em que mantém o código simples, objetivo desde projeto.
