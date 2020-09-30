# Radical Laravel Auth Preset

A Laravel authentication boilerplate made for the TALL stack.
Similar to the TALL stack preset, but with more opinions.

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

-   [ ] Add a logo component / partial 🌟
-   [ ] Clean up the command and/or add prompts
-   [ ] Add regular flash messages and rename current one to inline
-   [ ] Come up with a better name 🤔
-   [ ] Document requirements, like PHP 7.4
-   [ ] Add a License
-   [ ] Document what it does and comes with and the, like, opinions, man.
