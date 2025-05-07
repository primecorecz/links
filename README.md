# Install

```
composer require primecorecz/links
```

## Set db.table names in .env

```
PRIMECORE_LINKS_TABLE=magazine.links
PRIMECORE_TAGS_TABLE=magazine.tags
PRIMECORE_TAGGABLES_TABLE=magazine.taggables
PRIMECORE_POSTS_TABLE=magazine.posts
PRIMECORE_POSITIONS_TABLE=iris.positions
PRIMECORE_AREAS_TABLE=iris.areas
```

**!! All tables must be readable via default db connection**

## Update tailwind.config.js

```
...
module.exports = {
    ...
    content: [
        ...
        "./vendor/primecorecz/links/resources/**/*.blade.php",
        "./vendor/primecorecz/links/src/View/**/*.php",
    ],
    ...
}

```

test
