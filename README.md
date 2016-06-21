## Summary
Mustache é um micro-framework MVC para php Open Source com um motor básico para trabalhar em MVC de forma simples com URLs amigaveis.

## Installation

Clone esse repositório ou faça o download do zip e coloque em um diretório onde seu servidor web tenha acesso.

Configure o arquivo hosts do seu Sistema Operacional para acessar o seu servidor web com um hostname, por exemplo:

```
    127.0.0.1   mustache.dev
```

Crie um virtual host em seu servidor para acessar diretamente a pasta public dentro da raiz do mustache

```
# mustache 127.0.0.1:80
<VirtualHost *:80>
ServerName mustache.dev
DocumentRoot "/var/www/mustache/public"
</VirtualHost>
```