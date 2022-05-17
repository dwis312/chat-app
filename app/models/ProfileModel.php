<?php
require_once dirname(dirname(__DIR__)) . "/core/DbModel.php";

class ProfileModel extends DbModel
{
    const VALUE_PROF = 'Employee';
    const VALUE_CITY = 'Uknown';
    const VALUE_PHOTO = 'default.jpg';

    public $photo = self::VALUE_PHOTO;
    public string $name = '';
    public string $profesi = self::VALUE_PROF;
    public string $city = self::VALUE_CITY;
    public string $phone = '';

    public function tablename(): string
    {
        return 'profile';
    }

    public function primaryKey(): string
    {
        return 'profile_id';
    }

    public function getDisplayName(): string
    {
        return $this->name;
    }

    public function userProfile()
    {
        $this->unique_id = App::isGuest()->unique_id;

        if ($this->unique_id === App::isGuest()->unique_id) {
            return parent::getProfile(['unique_id' => $this->unique_id]);
        }
    }

    public function edit()
    {
        return parent::updateProfile();
    }

    public function attributes(): array
    {
        return [
            'photo',
            'name',
            'city',
            'profesi',
            'phone',
        ];
    }

    public function rules(): array
    {
        return $this->update();
    }

    public function update()
    {
        $oldValue = $this->userProfile();
        $newValue = $this;

        $rules = [
            'name' => [
                [self::RULE_MIN, 'min' => '2'],
                [self::RULE_MAX, 'max' => '24']
            ],
        ];

        if ($oldValue->phone != $newValue->phone) {
            $rules['phone'] = [
                [self::RULE_UNIQUE, 'class' => self::class],
                [self::RULE_MIN, 'min' => '12'],
                [self::RULE_MAX, 'max' => '14']
            ];
        }

        if ($oldValue->photo != $newValue->photo['name']) {
            $rules['photo'] = [
                self::RULE_FILE_EXT,
                self::RULE_FILE_TYPE,
                self::RULE_FILE_SIZE,
            ];
        }

        return $rules;
    }

    public function labels(): array
    {
        return [
            'photo' => 'Photo',
            'name' => 'Name',
            'city' => 'City',
            'profesi' => 'Profesi',
            'phone' => 'Phone',
        ];
    }
}
