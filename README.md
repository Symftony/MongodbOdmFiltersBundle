# MongodbOdmFiltersBundle

This bundle just allow you to inject service in Doctrine filter param with the dependency injection `@services`
You can also put parameter with `%parameter.name%` (Resolve by Symfony compiler pass)

```yaml

doctrine_mongodb:
    ...
    document_managers:
        default:
            filters:
                my_filter:
                    class: MyFilterClass
                    parameters:
                        token_storage: "@services"
                    enabled: true

```