# Treinalise




## Alterações no Template Gull

Detalhes dos arquivos que foram modificados no template original do Gull Admin Panel para chegar nas cores desejadas para o site.

- Criado o arquivo *_custom_colors.scss* dentro da pasta ``resources\gull\assets\styles\sass\themes`` para definir as novas cores utilizadas.
````
  "jet": #363735,
  "onyx": #3b3c3a,
  "coffee": #684b39,
  "orange-crayola": #ee7534,
  "chocolate-web": #ce6426,
  "linen": #f7e8e0,
  "cultured": #f7f7f7,
````
- Criado o arquivo *lite_custom.scss* com as configurações do novo tema nesta nova pasta e importado no webpack.mix.js

### Alterações na pasta Globals: ``resources\gull\assets\styles\sass\globals``

Dentro da pasta ``layouts`` contém arquivos comuns a todos os sub-templates:
- _footer.scss
````
.app-footer {
    background: $gray-300;
}
````

#### Na pasta ``layouts\sidebar-large``, template utilizado no admin do site:

- _header.scss
````
.main-header {
    background: $dark;
    .menu-toggle {
        div {
            background: $light
        }
    }
    .search-bar {
        background: $gray-300;
        border: 1px solid $gray-400;
    }
    .header-icon {
        color: $background;
        &:hover {
            background: $primary;
        }
    }
}
````

- _layout-sidebar-large.scss:
````
.main-content-wrap {
    background: $background;
}
.layout-sidebar-large {
    .sidebar-left-secondary,
    .sidebar-left {
        background: $primary-base;
    }
    .sidebar-left {
        .navigation-left {
            .nav-item {
                border-bottom: 1px solid $heading;
                &.active {
                    color: $secondary;
                    .nav-item-hold {
                        color: $secondary;
                    }
                }
                .nav-item-hold {
                    color: $light;
                }
                a {
                    color: $light;
                }
                &.active .triangle {
                    border-color: transparent transparent $dark-heading
                }
            }
        }
    }
}
.sidebar-left-secondary {
    background: $gray-100;
    .childNav {
        li.nav-item {
            a {
                color: $secondary;
                &:hover {
                    background: $gray-300;
                }
                &.open {
                    color: $secondary;
                }
                .nav-icon {
                    color: $secondary;
                }
            }
        }
    }
}
````

Na pasta ``layouts\vertical-sidebar``:

- 