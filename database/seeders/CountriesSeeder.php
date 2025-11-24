<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ["name" => "Afghanistan", "code" => "+93"],
            ["name" => "Albania", "code" => "+355"],
            ["name" => "Algeria", "code" => "+213"],
            ["name" => "Andorra", "code" => "+376"],
            ["name" => "Angola", "code" => "+244"],
            ["name" => "Antigua and Barbuda", "code" => "+1‑268"],
            ["name" => "Argentina", "code" => "+54"],
            ["name" => "Armenia", "code" => "+374"],
            ["name" => "Aruba", "code" => "+297"],
            ["name" => "Australia", "code" => "+61"],
            ["name" => "Austria", "code" => "+43"],
            ["name" => "Azerbaijan", "code" => "+994"],
            ["name" => "Bahamas", "code" => "+1‑242"],
            ["name" => "Bahrain", "code" => "+973"],
            ["name" => "Bangladesh", "code" => "+880"],
            ["name" => "Barbados", "code" => "+1‑246"],
            ["name" => "Belarus", "code" => "+375"],
            ["name" => "Belgium", "code" => "+32"],
            ["name" => "Belize", "code" => "+501"],
            ["name" => "Benin", "code" => "+229"],
            ["name" => "Bhutan", "code" => "+975"],
            ["name" => "Bolivia", "code" => "+591"],
            ["name" => "Bosnia and Herzegovina", "code" => "+387"],
            ["name" => "Botswana", "code" => "+267"],
            ["name" => "Brazil", "code" => "+55"],
            ["name" => "Brunei", "code" => "+673"],
            ["name" => "Bulgaria", "code" => "+359"],
            ["name" => "Burkina Faso", "code" => "+226"],
            ["name" => "Burundi", "code" => "+257"],
            ["name" => "Cambodia", "code" => "+855"],
            ["name" => "Cameroon", "code" => "+237"],
            ["name" => "Canada", "code" => "+1"],
            ["name" => "Cape Verde", "code" => "+238"],
            ["name" => "Central African Republic", "code" => "+236"],
            ["name" => "Chad", "code" => "+235"],
            ["name" => "Chile", "code" => "+56"],
            ["name" => "China", "code" => "+86"],
            ["name" => "Colombia", "code" => "+57"],
            ["name" => "Comoros", "code" => "+269"],
            ["name" => "Congo (Brazzaville)", "code" => "+242"],
            ["name" => "Costa Rica", "code" => "+506"],
            ["name" => "Croatia", "code" => "+385"],
            ["name" => "Cuba", "code" => "+53"],
            ["name" => "Cyprus", "code" => "+357"],
            ["name" => "Czech Republic", "code" => "+420"],
            ["name" => "Democratic Republic of the Congo", "code" => "+243"],
            ["name" => "Denmark", "code" => "+45"],
            ["name" => "Djibouti", "code" => "+253"],
            ["name" => "Dominica", "code" => "+1‑767"],
            ["name" => "Dominican Republic", "code" => "+1‑849"],
            ["name" => "Pakistan", "code" => "+92"],
            ["name" => "United States", "code" => "+1"],
            ["name" => "United Kingdom", "code" => "+44"],
            ["name" => "Germany", "code" => "+49"],
            ["name" => "France", "code" => "+33"],

        ];


        DB::table('countries')->insert($countries);
    }
}
