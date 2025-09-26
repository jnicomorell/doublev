# DoubleV Blog Module - Magento 2.4.7

## Descripción

Módulo de blog completo para Magento 2.4.7 desarrollado como prueba técnica para **DoubleV Partners**. Implementa un sistema de gestión de posts y comentarios con todas las mejores prácticas de Magento.

## Características Implementadas

### Requisitos Cumplidos

- **Tablas de BD** - Creadas con `db_schema.xml` declarativo
- **Auto-registro** - Módulo se registra automáticamente en Magento
- **Panel Admin** - Grid y formularios con UI Components
- **API REST** - Endpoints para posts y comentarios
- **Post inicial** - "Hello World" creado automáticamente
- **Arquitectura Magento** - Service contracts, repositories, interfaces

### Arquitectura Técnica

- **PHP 8.1+** con strict typing
- **Declarative Schema** (db_schema.xml)
- **Service Contracts** (Api/Interfaces)
- **Repository Pattern**
- **UI Components** con KnockoutJS
- **Data Patches** para setup
- **ACL Permissions**

## Instalación

### Paso 1: Estructura de Archivos
```bash
# Crear directorios
mkdir -p app/code/DoubleV/Blog

# Copiar todos los archivos del módulo a la estructura correspondiente
```

### Paso 2: Comandos de Magento
```bash
php bin/magento module:enable DoubleV_Blog
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

### Paso 3: Verificación
- Ir a **Admin Panel > Blog**
- Verificar que aparece el post "Hello World - DoubleV Blog"
- Probar crear nuevos posts

## API Endpoints

### Posts
```http
GET /rest/V1/doublev-blog/posts
GET /rest/V1/doublev-blog/posts/{postId}
```

### Comentarios
```http
GET /rest/V1/doublev-blog/posts/{postId}/comments
```

### Ejemplos de Uso
```bash
# Listar todos los posts
curl -X GET "https://tu-magento.com/rest/V1/doublev-blog/posts"

# Obtener post específico
curl -X GET "https://tu-magento.com/rest/V1/doublev-blog/posts/1"

# Comentarios de un post
curl -X GET "https://tu-magento.com/rest/V1/doublev-blog/posts/1/comments"
```

## Esquema de Base de Datos

### Tabla `doublev_blog_post`
- `post_id` (PK, auto-increment)
- `title` (VARCHAR 255, required)
- `content` (TEXT, required)  
- `author` (VARCHAR 255, required)
- `is_active` (BOOLEAN, default 1)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### Tabla `doublev_blog_comment`
- `comment_id` (PK, auto-increment)
- `post_id` (FK a doublev_blog_post)
- `author` (VARCHAR 255, required)
- `content` (TEXT, required)
- `email` (VARCHAR 255, required)
- `is_active` (BOOLEAN, default 1)
- `created_at` (TIMESTAMP)

## Funcionalidades Admin

### Grid de Posts
- Listado paginado con filtros
- Búsqueda por título/autor
- Acciones masivas (eliminar)
- Edición inline de campos
- Ordenamiento por columnas

### Formulario de Posts
- Editor WYSIWYG para contenido
- Validaciones en frontend y backend
- Toggle de activación
- Botones Save/Delete/Back

### Grid de Comentarios
- Vista de todos los comentarios
- Filtros por post, autor, estado
- Información de posts relacionados

## Permisos y ACL

```xml
DoubleV_Blog::blog          # Acceso principal
├── DoubleV_Blog::posts     # Gestión de posts
└── DoubleV_Blog::comments  # Gestión de comentarios
```

## Configuración del Sistema

Disponible en **Admin > Stores > Configuration > DoubleV > Blog Settings**:

- Enable/Disable del módulo
- Posts por página
- Configuraciones adicionales

## Testing y Validación

### Verificar Instalación
```bash
# Verificar módulo habilitado
php bin/magento module:status DoubleV_Blog

# Verificar tablas creadas
mysql -u user -p -e "SHOW TABLES LIKE 'doublev_blog_%';" database_name
```

### Validar API
```bash
# Test endpoint posts
curl -H "Accept: application/json" \
     "https://tu-magento.com/rest/V1/doublev-blog/posts"
```

## Rendimiento

- **Índices de BD** - Optimizados para consultas frecuentes
- **Lazy Loading** - Colecciones cargadas bajo demanda  
- **Cacheable** - Compatible con sistema cache de Magento
- **Paginación** - Grid con paginación eficiente

## 📝 Desarrollo

### Estándares de Código
- **PSR-12** - Estilo de código
- **Strict Typing** - PHP 8.1+
- **DocBlocks** - Documentación completa
- **SOLID Principles** - Arquitectura limpia
