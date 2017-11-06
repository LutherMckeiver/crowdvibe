<?php
namespace Edu\Cnm\crowdvibe\Test;

use Edu\Cnm\DataDesign\{Profile, Event, Rating};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Rating class
 *
 * This is a complete PHPUnit test of the Rating class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Rating
 * @author Matthew David <mcdav3636@gmail.com>
 **/

class RatingTest extends crowdvibeTest {
    /**
     * Profile that created the Rating; this is for foreign key relation
     * @var Rater profile
     **/
    protected $rater = null;

    /

    /**
     * valid profile hash to create the profile object to own the test
     * @var $VALID_HASH
     */
    protected $VALID_RATER_HASH;

    /**
     * valid salt to use to create the profile object to own the test
     * @var string $VALID_SALT
     */
    protected $VALID_RATER_SALT;

    /**
     * Profile that created the Rating; this is for foreign key relation
     * @var Ratee profile
     **/
    protected $retee = null;

    /**
     * valid profile hash to create the profile object to own the test
     * @var $VALID_HASH
     */
    protected $VALID_RATEE_HASH;

    /**
     * valid salt to use to create the profile object to own the test
     * @var string $VALID_SALT
     */
    protected $VALID_RATEE_SALT;

    /**
     * score of the Rating
     * @var string $VALID_RATINGSCORE
     **/
    protected $VALID_RATINGSCORE = "PHPUnit test passing";

    /**
     * content of the updated Tweet
     * @var string $VALID_RATINGSCORE2
     **/
    protected $VALID_RATINGSCORE2 = "PHPUnit test still passing";

    /**
     * type of the Rating- person or event
     * @car string $VALID_RATINGTYPE
     **/
    protected $VALID_RATINGTYPE = "PHPUnit test passing";

    /**
     * create dependent objects before running each test
     **/
    public final function setUp() : void {
        //run the default setUp() method first
        parent::setUp();
        password = "abc123";
        $this->VALID_RATER_SALT = bin2hex(random_bytes(32));
        $this->VALID_RATER_HASH = hash_pbkdf2("sha512", $password, $this->VALID_RATER_SALT, 262144);

        //create and insert a Rater to own the test Rating
        $this->rater = new Rater(generateUuidV4(), null,"@handle", "test@phpunit.de",$this->VALID_RATER_HASH, "+12125551212", $this->VALID_RATER_SALT);
        $this->rater->insert($this->getPDO());

        /**
         * create dependent objects before running each test
         **/
        public final function setUp() : void {
            //run the default setUp() method first
            parent::setUp();
            password = "abc123";
            $this->VALID_RATEE_SALT = bin2hex(random_bytes(32));
            $this->VALID_RATEE_HASH = hash_pbkdf2("sha512", $password, $this->VALID_RATEE_SALT, 262144);

            //create and insert a Rater to own the test Rating
            $this->rater = new Rater(generateUuidV4(), null,"@handle", "test@phpunit.de",$this->VALID_RATEE_HASH, "+12125551212", $this->VALID_RATEE_SALT);
            $this->rater->insert($this->getPDO());

            //
    }
}