##dvd-rental-tdd-example

    "Test behaviour not implementation"

Run single set of tests using 3 different implementations:

    crud based system with in-memory repository (unit tests)
    crud based system with Postgres repository
    event sourcing system with MongoDB as a storage

Each time tests passes -> you know all 3 implementations are correct in terms of business requirements (keeping above 90% test coverage)

    Run to setup dockers with postgres and Mongo:

./script/bootstrap
./script/migrate
./script/test

    change var currentFacadeBuilder = buildInMemoryCrudTestFacade in choose_facade.go to buildPostgresCrudTestFacade and run ./script/test/. Those tests acts as integration test right now.

    change var currentFacadeBuilder = buildPostgresCrudTestFacade in choose_facade.go to buildEventSourcedTestFacade and run ./script/test/. Those tests acts as integration test right now.

If you can completely change your implementation and tests passes, the same way you can safely refactor your code without breaking any tests!
###Presentation

This is a demonstration project for a purpose of presentation: https://www.slideshare.net/GrzegorzMiejski/tdd-done-right-tests-immutable-to-refactor-128144681

With common terminology used, rules for BDD-style tests and more advices.
###What is this project?

Purpose of this project is to show a way of doing unit testing - the real one, that allows to:

    refactor your code without breaking tests
    gain maximum safety that your code works with minimal testing
    make it easy to develop new features without breaking previous tests

And one more thing - you can find blogs and presentations about how to make your tests keep those properties (example). BUT!!! I haven't found any real project using those practises to show all related and relevant stuff, so here it is!
###How to read?

This is a simple DVD renting site, with some high level business requirements:

    view available movies
    rent movie by user
    return movie by user
    prolong rented movie
    get movie recommendations
    ...

And more specific ones (here using user stories):

    As a user I cannot rent more than 2 movies at same time
    As a user I cannot rent movies for which I’m too young
    As a user I cannot rent more movies if I have a fee to pay for keeping to long
    As a user ...

###Architecture

This is an image of architecture: (TODO image here)
###Build and run tests

./script/bootstrap

./script/migrate

./script/test
###What to see in this project?

    take a high-level look at project units (aka modules, aka bounded context): users, movies, fees, rental
    See what a unit facade is
    Run movies tests with coverage - see the high coverage percentage using only several tests
    What to see and do in rental module:

    take a look at the Facade API - here

    GO TO THE BIG THING!!!

###GO TO THE BIG THING!!!!

The main purpose of this project is to show how to write tests, where you can rewrite all you business logic (even using different architecture inside your unit) and without modifying tests you will know if your new implementation works the same way as previous one.

    Go to src/rental - there are 2 kind of tests:

    tests package holds unit tests that rental should pass
    integration_tests - which check if unit correctly setups HTTP api implemented here

    Go to rental/tests into test setup Change var currentFacadeBuilder to values below to check 3 different implementations using same tests:

    var currentFacadeBuilder = buildInMemoryCrudTestFacade - this runs real unit tests (without any dependency) and verifies you business logic works ok
    var currentFacadeBuilder = buildPostgresCrudTestFacade - tests if rental/rental_crud business logic works fine using real Postgresql setup in docker. This actually turns this tests to integration tests, as we're testing integration with Postgresql
    var currentFacadeBuilder = buildEventSourcedTestFacade - tests if rental/rental_es business logic works fine. It has completely different implementation than rental/rental_crud - based on event sourcing and MongoDB as a database.

RESULT? All tests passes - it shows that using those practises you can change your implementation, refactor your code safely and you won't have to touch your tests at all!

One thing to clarify (that normally you don't cover all same paths using unit-in-memory tests and unit-aka-integration-test) TODO
Other things to see:

    overwrite config values to keep tests minimal using options pattern (make maximumMoviesToRent==1) - here
    how dependency modules are stubbed/mocked - here and here
    see reporitory declared in domain package but implemented in infrastructure package (to keep domain not depending on infrastructure)
    each unit has it's own HTTP adapters, bus handler, etc (is sliced vertically, not horizontally in terms of layers)

###How to run all tests with coverage?

Because go normally counts coverage only when tests are in the same package,run tests with -coverpkg=./... to count globally (due to artificial split of rental unit for demonstration purposes):

go test -p=1 -coverpkg=./... ./...

WARNING!

This actually does not show correct numbers, but when you pass -coverpkg=./... -p=1 as Gotool arguments into IntelliJ Run configuration - you will show 90% coverage on testes units.
###TODO for more examples of implementation

    docker running tests
    impl rentals in postgres
    HTTP for rentals
    bus in memory
    mongodb event sourced

###FAQ

    "This is not how you should write in GO!"

    well, maybe - I'm coming from JVM word, where all those patterns can be written using much less code and it's more readable then. But in order to maintain properties of tests that I want to keep (immutable to refactor, etc), this is the only way of coding it for now, that works for me. Maybe one day somebody can make it better
    some thing in this repository are done specifically to make it easier to demonstrate specific things

    "Have questions/want to discuss something"

    You can find me on facebook - Grzesiek Miejski, or write an issue on Github -> I will be glad to respond!

###Other sources that say the same thing

    Uncle Bob dialog between 2 TDD-style guys - https://blog.cleancoder.com/uncle-bob/2017/10/03/TestContravariance.html
    Theoretical presentation with history overview - https://www.youtube.com/watch?v=EZ05e7EMOLM&index=67&list=WL&t
