# Cable

A Laravel Livewire authentication preset. As in, a bundle of wires.

## Installation

This will be improved next week, but for now, here's the best way to do it.
First, create a new Laravel 8 project.
Add the following to your `composer.json` file:

```json
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:austenc/rad-preset.git"
    }
]
```

Once that is done, run the following commands in this order:

```shell
composer update
npm install
npm run dev
```

## To Do:

-   [x] Come up with a better name 🤔
-   [x] Clean up the command and/or add prompts
-   [x] Rename current flash component to `x-inline-flash`
-   [ ] Add a logo component / partial 🌟
-   [ ] Document requirements, like PHP 7.4
-   [ ] Add a License (MIT)
-   [ ] Document what it does and comes with and the, like, opinions, man.
