<?php

namespace domain\Services;

use App\Models\student;
use domain\Facades\ImagesFacade;

class StudentService
{
    protected $student;

    public function __construct()
    {
        $this->student = new student();
    }

    // loding page
    public function all()
    {
        return $this->student->all();
    }

    // student store
    public function store($data)
    {
        if (isset($data['images'])) {
            $image = ImagesFacade::store($data['images']);
            $data['image'] = $image->name;
        }
        $this->student->create($data);
    }

    // student delete
    public function delete($student_id)
    {
        $this->student->destroy($student_id);
    }

    // student status change
    public function status($student_id)
    {
        $student = $this->student->find($student_id);
        if ($student->status == 0) {
            $student->status = 1;
            $student->update();
        } else {
            $student->status = 0;
            $student->update();
        }
    }
    // student update details geting
    public function edit($student_id)
    {
        return $this->student->find($student_id);
    }
    // student update

    public function update(array $data, $student_id)
    {

        $student = $this->student->find($student_id);
        $student->name = $data["name"];
        $student->age = $data["age"];
        $student->update();
    }
}
