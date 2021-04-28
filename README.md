# Pass sorter package docs
## Environment setup
- In order to run the code in this repository you must have PHP and Composer installed on your system or in a docker container.
- The minimum required version of PHP is 7.4.
- Clone the repository and open a terminal window at the root of this project and execute this command `composer dump-autoload`. To generate autoload files.
- Next you will need to provide your boardings data as json array in a json file readable by PHP process user.
- To execute the program run `php src/index.php path-to-your-input-file.json` at the root of the project.
- Or you can just run this `php src/index.php` to use the provided sample data.

## Big O Notation of the solution
- The time complexity in Big O Notation for the solution is O(n).

## Adding more transportation types
- In order to add more transportations, all you have to do is to create a new class at under the `Hamedov\PassSorter\Transportations` namespace with the same name as the type of transportation. For example if the new type is `car` the class should be named `Car` and must extend the abstract Transportation class and implement the `getInstructions method`.

## Side notes
- There might be better solutions for the problem but I am short in time and I just started working at 11pm becasue I was busy.
- There could be also some unit tests and better documentation to the code.
