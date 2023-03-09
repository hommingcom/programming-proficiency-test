# HOMMING PROGRAMMING PROFICIENCY TEST (HPPT)

**WELCOME CHALLENGER** to the ~~HTTP~~ HPPT, we are going to test your proficiency as a programmer! ʕ ᓀ ᴥ ᓂ ʔ

> **DISCLAIMER:** Make the code to do what you want is only the first step, we expect elegant and optimal solutions since the problems are not challenging!

## SETUP

You will find a dockerfile and a docker-compose.yml in your project root, that can only mean one thing... a dockerized project! So you may have guess the first step of this test already. Set it up and running!

## PHP

The backend part is more logic oriented, nothing pragmatic, unless you really like roman numbers for some reason...

You have a `src` folder with multiple files, each of them contains a function. You need to complete that function with the logic necessary to pass the tests.

You can check your logic running `docker-compose exec app php vendor/bin/phpunit`.

## JAVASCRIPT

This is a more pragmatic approach, this consists on a basic table CRUD, filtering and testing.

Your workspace is `resources` and your tests live in `tests/js`, appart from that you can organize your files as you wish. You will start with an stub containing data and your objetive is:

- Create a table which list the properties
- Add extra columns to the properties table including months the property has been rented for and a boolean expresing if the property is currently being rented out
- Be able to filter by property types, user and dates
- (Optional) Listen to URL parameters to filter on page load. e.g. `?user=1`
- (Optional) Install and use TailwindCSS to style your stuff properly.

You can check your work running `docker-compose exec app npm run serve` and accessing your `localhost:8080`.

## HOW TO HAND IN YOUR WORK

Please, fork this repository and submit a Pull Request with your solutions so we can check it out.

**BEST OF LUCK CHALLENGER.**

**INSTRUCTIONS OF USE AND COMMENTS from the challenger** _by Friosn_

**Backend** --> to set it up and running with docker: `docker compose up -d` (with the -d option, it will run in detached, so you will be able to keep writing in the same terminal to run the tests).
Run the tests --> `docker-compose exec app php vendor/bin/phpunit`
I installed a linter library, since I did not know with wich one you are normally working I installed CodeSniffer, I also let here the commands:
`composer lint` : Checks if there are 'anomalies' in the code structure standars.
`composer lint:autofix`: Fixes them automatically if possible.

**Frontend** --> to set it up and running (http://localhost:8081/): _npm run serve_ or, as in my case; _node_modules/.bin/vue-cli-service serve resources/main.js_; If that should give any proble, adding --fix at the end of the command would fix the issue.

For the front part of the application I did not have much time left so I did a first approach in the time I had. The filters, URL parameter and TailwindCSS are the parts that are missing. It's worth saying that it was my first time using 3 of the main technologies I used in this test; Docker, PHP and Vue.js. I loved to have the oportunity of doing this challenge and learn with it. Thanks 👨🏻‍💻
