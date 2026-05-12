<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        $problems = [
            'Persistent headache and dizziness for the past 3 days.',
            'Severe lower back pain radiating to the left leg.',
            'Chronic fatigue and shortness of breath on exertion.',
            'Recurrent stomach pain with nausea after meals.',
            'High blood pressure readings over the past week.',
            'Skin rash on arms and chest, suspected allergy.',
            'Frequent urination and excessive thirst.',
            'Joint pain and morning stiffness in both knees.',
            'Persistent dry cough with mild fever.',
            'Chest tightness and palpitations.',
        ];

        $solutions = [
            'Prescribed Paracetamol 500mg and rest. Follow up in one week.',
            'Referred for lumbar MRI. Prescribed muscle relaxants and physiotherapy.',
            'Blood tests ordered. Advised iron-rich diet and vitamin supplements.',
            'Prescribed antacids. Recommended dietary adjustments and stress reduction.',
            'Started Amlodipine 5mg daily. Blood pressure monitoring advised.',
            'Prescribed antihistamines and topical corticosteroid cream.',
            'Fasting blood glucose and HbA1c ordered. Low-sugar diet advised.',
            'Prescribed anti-inflammatory medication. Knee X-ray scheduled.',
            'Chest X-ray ordered. Prescribed cough suppressant and paracetamol.',
            'ECG performed. Referred to cardiologist for further evaluation.',
        ];

        $notesSets = [
            ['Patient seems anxious — reassure on next visit.', 'Remind patient to bring previous lab results.'],
            ['Follow up required after MRI results.'],
            ['Patient travels frequently — advised remote monitoring.', 'Discuss dietary plan in detail on next visit.'],
            ['No drug allergies reported.'],
            ['Patient on Ramadan fasting — adjust medication timing accordingly.', 'Recheck BP after 2 weeks.'],
            [],
            ['Fasting blood test booked for next Thursday.'],
            ['Patient reports difficulty climbing stairs.', 'Refer to physiotherapy if no improvement.'],
            [],
            ['ECG results pending. Urgent follow-up if symptoms worsen.'],
        ];

        $index = fake()->numberBetween(0, 9);

        return [
            'name' => fake()->name(),

            'national_id' => fake()->unique()->numerify('##############'),

            'mobile' => fake()->unique()->numerify('010########'),

            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),

            'marital_status' => fake()->randomElement(['single', 'married', 'divorced', 'widowed']),

            'children_count' => fake()->numberBetween(0, 5),

            'governorate' => fake()->randomElement([
                'Cairo', 'Giza', 'Alexandria', 'Dakahlia', 'Beheira',
                'Gharbia', 'Qalyubia', 'Sharqia', 'Monufia', 'Faiyum',
                'Minya', 'Asyut', 'Sohag', 'Qena', 'Luxor',
                'Aswan', 'Port Said', 'Ismailia', 'Suez', 'Damietta',
            ]),

            'address' => fake()->streetAddress() . ', ' . fake()->city(),

            'problem'      => $problems[$index],
            'solution'     => $solutions[$index],
            'notes'        => $notesSets[$index],
            'visit_date'   => fake()->dateTimeBetween('-6 months', 'now'),
            'is_completed' => fake()->boolean(40),

            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
