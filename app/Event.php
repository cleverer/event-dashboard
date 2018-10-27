<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class Event
 * @package App
 */
class Event extends Model
{
    use SoftDeletes;

	/**
	 * @var array
	 */
	protected $fillable = [
        'title',
        'date',
        'description',
        'contact_email',
        'time',
        'location',
        'costs',
        'registration_required',
        'registration_email',
        'registration_tel',
        'registration_url',
        'contact_name',
        'contact_tel',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

	/**
	 * @var string|null
	 */
	public $raw_token = null;

	/**
	 * Hashes the edit_token
	 * @throws \Exception
	 */
	public function beforeSave(): void {
	    if (is_null($this->edit_token)) {
		    $token = static::generateToken();
	        $this->edit_token = Hash::make($token);
	        $this->raw_token = $token;
        }
    }

	/**
	 * @param int $length
	 * @return string
	 * @throws \Exception
	 */
	public static function generateToken(int $length = 20): string {
		return bin2hex(random_bytes($length));
    }

	/**
	 * @return string
	 */
	public function getFormattedDate(): string {
        $carbon = Carbon::parse($this->date);
        return $carbon->isoFormat('L');
    }

	/**
	 * @return string
	 */
	public function getFormattedTime(): string {
	    if (is_null($this->time)) {
		    return "";
	    }
        $carbon = Carbon::parse($this->time);
        return $carbon->isoFormat('LT');
    }

	/**
	 * @return bool
	 */
	public function hasContactInfo(): bool {
        return !(is_null($this->contact_name) && is_null($this->contact_tel) && is_null($this->contact_email));
    }

	/**
	 * @return bool
	 */
	public function hasRegistrationInfo(): bool {
        return !(is_null($this->registration_email) && is_null($this->registration_tel) && is_null($this->registration_url));
    }

	/**
	 * @return array
	 */
	public function getContactInfo(): array {
		$contact = [
			htmlspecialchars($this->contact_name),
		];
		if (!is_null($this->contact_tel)) {
			$contact[] = '<a href="tel:'.static::formatPhoneNumber(htmlspecialchars($this->contact_tel)).'">'.htmlspecialchars($this->contact_tel).'</a>';
		}
		if (!is_null($this->contact_email)) {
			$contact[] = '<a href="mailto:'.htmlspecialchars($this->contact_email).'">'.htmlspecialchars($this->contact_email).'</a>';
		}
		return array_filter($contact);
    }

	/**
	 * @return array
	 */
	public function getRegistrationInfo(): array {
		$registration = [];
		if (!is_null($this->registration_email) && !empty($this->registration_email)) {
			$registration[] = '<a href="mailto:'.htmlspecialchars($this->registration_email).'">'.htmlspecialchars($this->registration_email).'</a>';
		}
		if (!is_null($this->registration_tel) && !empty($this->registration_tel)) {
			$registration[] = '<a href="tel:'.static::formatPhoneNumber(htmlspecialchars($this->registration_tel)).'">'.htmlspecialchars($this->registration_tel).'</a>';
		}
		if (!is_null($this->registration_url) && !empty($this->registration_url)) {
			$registration[] = '<a href="'.htmlspecialchars($this->registration_url).'">'.htmlspecialchars($this->registration_url).'</a>';
		}
		return array_filter($registration);
    }

	/**
	 * @param string $number
	 * @return string
	 */
	private static function formatPhoneNumber(string $number): string {
        return preg_replace('/\s+/', '', str_replace('+', '00', $number));
    }
}
