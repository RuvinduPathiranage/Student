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
    public function all()
    {
        return $this->student->all();
    }
    public function store($data)
    {
        // dd($data);
        if (isset($data['images'])) {
            $image = ImagesFacade::store($data['images']);
            $data['image'] = $image->name;
            // dd($data);
        }
        $this->student->create($data);
    }
    public function delete($student_id)
    {
        $this->student->destroy($student_id);
    }
    public function status($student_id)
    {
        $student = $this->student->find($student_id);
        if ($student->status == 0) {
            $student->status = 1;
            $student->update();
        }else{
            $student->status = 0;
            $student->update();
        }
    }
    public function edit($student_id)
    {
        return $this->student->find($student_id);
    }

    public function update(array $data, $student_id)
    {

        $student = $this->student->find($student_id);
        $student->name = $data["name"];
        $student->age = $data["age"];
        $student->update();
    }
}

