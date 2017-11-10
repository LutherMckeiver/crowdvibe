<?php
namespace Edu\Cnm\CrowdVibe;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Prophecy\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid;

/**
 * An event is user created, it is allow people to join you in any activity you are participating in.
 *
 * @author Luther Mckeiver <lmckeiver@cnm.edu>
 * @version 1.0.0
 **/

class Event implements \JsonSerializable {
    use ValidateDate;
    /**
     * id for this Event; this is the primary key
     * @var int $eventId
     **/
    private $eventId;

    /**
     * id of the profile that sent the event, this is foreign key
     * @var int $eventProfileId;
     **/
    private $eventProfileId;
    /**
     * this is the actual text detail of the event
     *
     * @var string $eventDetail
     **/
    private $eventDetail;
    /**
     * this is the latitude of the event
     *
     * @var float $eventLat
     **/
    private $eventLat;
    /**
     * this is the longitude of the event
     *
     * @var float $eventLong
     **/
    private $eventLong;
    /**
     * this specifies whether the event will cost money or will be free
     *
     * @var float $eventPrice
     **/
    private $eventPrice;
    /**
     * this will specify when the event will begin
     *
     * @var \DateTime $eventStartTime
     **/
    private $eventStartDateTime;
    /**
     * this specifies the time the event will end.
     *
     * @var \DateTime $eventEndStartTime
     **/
    private $eventEndDateTime;
    /**
     * this specifies the limit of individuals that can attend an event
     *
     * @var int $eventAttendeeLimit
     **/
    private $eventAttendeeLimit;
    /**
     * this is an image for an event
     *
     * @var null $eventImage
     */
    private $eventImage;
    /**
     * this is the name of the event
     *
     * @var string $eventName
     */
    private $eventName;


    /**
     * Event constructor.
     * @param int|null $newEventId
     * @param int $newEventProfileId
     * @param string $newEventDetail
     * @param \DateTime|null $newEventStartDateTime
     * @param \DateTime|null $newEventEndDateTime
     * @param int $newEventPrice
     * @param float $newEventLat
     * @param float $newEventLong
     * @param null $eventImage
     * @param string $newEventName
     */

    public function __construct(?int $newEventId, int $newEventProfileId, string $newEventDetail, \DateTime $newEventStartDateTime =
    null, \DateTime $newEventEndStartTime = null, int $newEventPrice, float $newEventLat, float $newEventLong, $eventImage= null, string $newEventName){
    try {
        $this->setEventId($newEventId);
        $this->setEventProfileId($newEventProfileId);
        $this->setEventDetail($newEventDetail);
        $this->setEventStartDateTime($newEventStartDateTime);
        $this->setEventEndDateTime($newEventEndDateTime);
        $this->setEventPrice($newEventPrice);
        $this->setEventLat($newEventLat);
        $this->setEventLong($newEventLong);
        $this->setEventImage($newEventImage);
        $this->setEventName($newEventName);

    }
    //determine what exception type was thrown
        catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {$exceptionType = get_class($exception);
        throw (new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }

    /**
     * accessor method for event id
     *
     * @return int|null value of event id
     **/
    /**
     * @return int
     */
    public function getEventId(): int {
        return $this->eventId;
    }

    /**
     * mutator method for event id
     *
     * @param int|null $newEventId new value of event id
     * @throws \RangeException if $nevEventId is not positive
     * @throws \TypeError if $newEventId is not an integer
     **/
    public function setEventId(?int $newEventId) : void {
        //if event id is null immediately return it
        if($newEventId===null) {
            $this->eventId = null;
            return;
        }

        // verify if the event id is positive
        if ($newEventId <= 0) {
            throw (new \RangeException("event id is not positive"));
        }

        //convert and store the event id
        $this->eventId = $newEventId;
    }
    /**
     * accessor method for event profile id
     *
     * @return int value of event profile id
     **/
    /**
     * @return int
     */
    public function getEventProfileId(): int {
        return $this->eventProfileId;
    }

    /**
     * mutator method for event profile id
     *
     * @param int $newEventProfileId new value of event profile id
     * @throws \RangeException if $newProfileId is not positive
     * @throws \TypeError if $newProfileId is not an integer
     **/
    public function setEventProfileId(int $newEventProfileId) : void {

        //verify the event id is positive
        if ($newEventProfileId <= 0) {
            throw (new \RangeException("event profile id is not positive"));
        }

        //convert and store the profile id
        $this->eventProfileId = $newEventProfileId;
    }

    /**
     * accessor method for event detail
     *
     * @return string value of event detail
     **/
    /**
     * @return string
     */
    public function getEventDetail(): string {
        return $this->eventDetail;
    }

    /**
     * mutator method for event detail
     *
     * @param string $newEventDetail new value of event detail
     * @throws \InvalidArgumentException if $newEventDetail is not a string or insecure
     * @throws \RangeException if $newEventDetail is > 500
     * @throws \TypeError if $newEventDetail is not a string
     **/
    public function setEventDetail(string $newEventDetail) : void {
        // verify the event detail is secure
        $newEventDetail = trim($newEventDetail);
        $newEventDetail =filter_var($newEventDetail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (empty($newEventDetail)=== true) {
            throw (new \InvalidArgumentException("event detail is empty or insecure"));
        }
        //verify the event detail will fit in the database
        if (strlen($newEventDetail) > 500) {
            throw (new \RangeException("event content is too long"));
        }
        //store the event detail
        $this->eventDetail = $newEventDetail;
    }
    /**
     * accessor method for event name
     *
     * @return string value of event name
     **/
    /**
     * @return string
     */
    public function getEventName(): string {
        return $this->eventName;
    }

    /**
     * mutator method for event name
     *
     * @param string $newEventName new value of event name
     * @throws \InvalidArgumentException if $newEventName is not a string or insecure
     * @throws \RangeException if $newEventName is > 64 characters
     * @throw \TypeError if $newEventName is not a string
     **/
    public function setEventName(string $newEventName) : void {
        //verify the event name is secure
        $newEventName = trim($newEventName);
        $newEventName = filter_var($newEventName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (empty($newEventName) ===true) {
            throw (new \InvalidArgumentException("event name is empty or insecure"));
        }
        //verify the event name will fit in the database
        if (strlen($newEventName)> 64) {
            throw (new \RangeException("event name is too long"));
        }

        // store the event name
        $this->eventName = $newEventName;
    }

    /**
     * accessor method for event image
     *
     * @return string value of event image
     * @return null
     **/
    public function getEventImage() {
        return $this->eventImage;
    }

    /**
     * mutator method for event image
     *
     * @param string $newEventImage new value of event image
     * @throws \InvalidArgumentException if $newEventImage is not not a string or insecure
     * @throws \RangeException if $newEventImage is > 64 characters
     * @throw \TypeError if $newEventImage is not a string
     **/
    public function setEventImage (string $newEventImage) : void {
        // verify the image is insecure
        $newEventImage = trim($newEventImage);
        $newEventImage = filter_var($newEventImage, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (empty($newEventImage)===true) {
            throw (new \InvalidArgumentException("event image is empty or insecure"));
        }
        // verify the event image will fit in the database
        if (strlen($newEventImage)> 64) {
            throw (new \RangeException("event image is too long"));
        }
        //store the event image
        $this->eventImage = $newEventImage;
    }

    /**
     * formats the state variables for JSON serialization
     *
     * @return array resulting state variables to serialize
     **/
    public function jsonSerialize() {
        $fields = get_object_vars($this);
        //format the date so that the front end can consume it
        $fields["eventStartDateTime"] = round(floatval($this->eventStartDateTime->format("U.u")) * 1000);
        return($fields);
    }


    }






