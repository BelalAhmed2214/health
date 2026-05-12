<?php
namespace App\Http\DTOs;

use Illuminate\Http\Request;

class UpdatePatientDTO{
    public function __construct(
        public ?string $name,
        public ?string $national_id,
        public ?string $mobile,
        public ?string $date_of_birth,
        public ?string $marital_status,
        public ?int $children_count,
        public ?string $governorate,
        public ?string $address,
        public ?string $problem,
        public ?string $solution,
        public ?array $notes,
        public ?string $visit_date,
        public ?float $price,
        public ?string $follower,
    ){}
    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            national_id: $request->national_id,
            mobile: $request->mobile,
            date_of_birth: $request->date_of_birth,
            marital_status: $request->marital_status,
            children_count: $request->children_count,
            governorate: $request->governorate,
            address: $request->address,
            problem: $request->problem,
            solution: $request->solution,
            notes: $request->notes,
            visit_date: $request->visit_date,
            price: $request->price,
            follower: $request->follower,
        );
    }
    public function toArray(): array
    {
        return [
            'name'           => $this->name,
            'national_id'    => $this->national_id,
            'mobile'         => $this->mobile,
            'date_of_birth'  => $this->date_of_birth,
            'marital_status' => $this->marital_status,
            'children_count' => $this->children_count,
            'governorate'    => $this->governorate,
            'address'        => $this->address,
            'problem'        => $this->problem,
            'solution'       => $this->solution,
            'notes'          => $this->notes,
            'visit_date'     => $this->visit_date,
            'price'          => $this->price,
            'follower'       => $this->follower,
        ];
    }
}