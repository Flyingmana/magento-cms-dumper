# magento-cms-dumper
A Magento1 module to dump and import cms content, so you can easy sync this content via vcs and your normal deployment workflow

Hint: yes I know this is not a fully valid module, feel free to do a PR

## Usage

`php ./shell/cms/export.php all`

and

`php ./shell/cms/import.php all`

It does only update (maybe create) entries, id does not support delete. Just use the "disable" functionality inside magento for this.


## Todo

* check if the import for blocks does even work (not tested yet, had enough after it worked for pages)
* allow import/export of single IDs via commandline argument
* add modman file
* add composer.json
* add proper module structure/config
* ask people if they want this functionality for M2
* add doku for usage together with setup scripts (like, just call this one method of the service class)
* check what happens if the Page/Block does not exist yet, especially regarding the ID

example result in filesystem:

```
ubuntu@vagrant:/vagrant/data/magento/var/export/cms$ tree -l
.
├── cms_block
│   ├── 100.json
│   ├── 101.json
│   ├── 102.json
│   ├── 103.json
│   ├── 104.json
│   ├── 105.json
│   ├── 1.json
│   ├── 2.json
│   ├── 3.json
│   ├── 4.json
│   ├── 5.json
│   ├── 81.json
│   ├── 82.json
│   ├── 83.json
│   ├── 84.json
│   ├── 86.json
│   ├── 87.json
│   ├── 88.json
│   ├── 89.json
│   ├── 90.json
│   ├── 91.json
│   ├── 92.json
│   ├── 93.json
│   ├── 94.json
│   ├── 95.json
│   ├── 96.json
│   ├── 97.json
│   ├── 98.json
│   └── 99.json
└── cms_page
    ├── 10.json
    ├── 11.json
    ├── 12.json
    ├── 13.json
    ├── 14.json
    ├── 17.json
    ├── 18.json
    ├── 19.json
    ├── 20.json
    ├── 27.json
    ├── 2.json
    ├── 41.json
    ├── 43.json
    ├── 4.json
    ├── 59.json
    ├── 5.json
    ├── 60.json
    ├── 61.json
    ├── 62.json
    ├── 63.json
    ├── 64.json
    ├── 65.json
    ├── 66.json
    ├── 67.json
    ├── 68.json
    ├── 69.json
    ├── 6.json
    ├── 70.json
    ├── 71.json
    ├── 72.json
    ├── 7.json
    ├── 8.json
    └── 9.json

2 directories, 62 files
```


