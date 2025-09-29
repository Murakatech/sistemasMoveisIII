# Estrutura de Imagens do Sistema

Este diretório contém todas as imagens utilizadas no sistema de listas de compras.

## Estrutura de Diretórios

### `/products/`
- **Finalidade**: Imagens dos produtos cadastrados
- **Formato recomendado**: JPG, PNG, WebP
- **Tamanho recomendado**: 400x400px (quadrado)
- **Tamanho máximo**: 2MB por imagem
- **Nomenclatura**: `produto_id.extensao` (ex: `1.jpg`, `2.png`)

### `/categories/`
- **Finalidade**: Ícones e imagens das categorias
- **Formato recomendado**: SVG, PNG
- **Tamanho recomendado**: 64x64px para ícones, 300x200px para banners
- **Tamanho máximo**: 1MB por imagem
- **Nomenclatura**: `categoria_id.extensao` (ex: `1.svg`, `2.png`)

### `/system/`
- **Finalidade**: Imagens do sistema (logos, backgrounds, etc.)
- **Formato recomendado**: SVG, PNG, JPG
- **Conteúdo sugerido**:
  - `logo.svg` - Logo principal do sistema
  - `logo-small.svg` - Logo pequeno para navbar
  - `background.jpg` - Background da página de login
  - `placeholder-product.svg` - Imagem padrão para produtos sem foto
  - `placeholder-category.svg` - Imagem padrão para categorias sem ícone

## Como Adicionar Imagens

### Para Produtos:
1. Faça upload da imagem para `/public/images/products/`
2. Renomeie para o ID do produto (ex: `15.jpg`)
3. Atualize o campo `image` na tabela `products` com o nome do arquivo

### Para Categorias:
1. Faça upload da imagem para `/public/images/categories/`
2. Renomeie para o ID da categoria (ex: `3.svg`)
3. Atualize o campo `image` na tabela `categories` com o nome do arquivo

### Para Sistema:
1. Faça upload da imagem para `/public/images/system/`
2. Use nomes descritivos (ex: `logo.svg`, `background.jpg`)
3. Referencie nas views usando `asset('images/system/nome-arquivo.ext')`

## Otimização de Imagens

### Recomendações:
- Use WebP quando possível para melhor compressão
- Otimize imagens antes do upload (TinyPNG, ImageOptim)
- Use SVG para ícones e logos
- Mantenha proporções adequadas para evitar distorção

### Ferramentas Recomendadas:
- **Compressão**: TinyPNG, ImageOptim
- **Edição**: GIMP, Photoshop, Canva
- **SVG**: Inkscape, Adobe Illustrator

## Backup e Versionamento

- Mantenha backup das imagens originais
- Use Git LFS para arquivos grandes (>100MB)
- Documente mudanças significativas nas imagens do sistema

## Exemplo de Uso no Código

```php
// Em uma view Blade
<img src="{{ asset('images/products/' . $product->image) }}" 
     alt="{{ $product->title }}" 
     class="img-fluid">

// Verificar se imagem existe
@if($product->image && file_exists(public_path('images/products/' . $product->image)))
    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->title }}">
@else
    <img src="{{ asset('images/system/placeholder-product.svg') }}" alt="Sem imagem">
@endif
```

## Permissões

Certifique-se de que o diretório `public/images/` tenha permissões de escrita para o servidor web.

```bash
# Linux/Mac
chmod -R 755 public/images/

# Verificar permissões
ls -la public/images/
```