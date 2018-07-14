# SeComS
Sistema de e-Commerce Simples - Teste Prático
###### Configuração do server de email
Para o correto funcionamento do envio de e-mails pelo PHPMailer, é necessário incluir alguns valores nas variáveis:
- No script server **/src/email/envioemailphpmailer.php**
```
17    $mail->Host = 'smtp1.example.com;smtp2.example.com';
```
> Ex.: smtp.gmail.com para uma conta do Gmail.

```
19    $mail->Username = 'user@example.com';
20    $mail->Password = 'secret';
```
> O endereço de e-mail e senha da conta que enviará os e-mails

- Na classe **/src/controller/CompraController.php**
```
13    $emailPara = 'email_destino_compra@gmail.com';
```
> informar a conta de e-mail que receberá um pedido de compra

###### Configuração da base de dados MySQL
Preencha seu usuário e senha na classe **/src/connectionfactory/Conexaodb.class.php**
```
8    protected $user = "root";
9    protected $pass = "";
```
Execute o comando **source caminho/do/script/sql/secoms.sql**
*Caso queira alterar o nome da base de dados, modifique a variável protected $banco = "secoms"; No entanto, deve-se alterar também o nome no script sql*