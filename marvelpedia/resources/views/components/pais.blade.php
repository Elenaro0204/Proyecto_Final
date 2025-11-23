<!-- resources/views/components/pais.blade.php -->
@props(['user' => null])

@php
// Array de países con sus códigos ISO 3166-1 alpha-2
$countries = [
    'AF' => 'Afganistán','AL' => 'Albania','DE' => 'Alemania','AD' => 'Andorra','AO' => 'Angola','AG' => 'Antigua y Barbuda','SA' => 'Arabia Saudita',
    'AM' => 'Armenia','AU' => 'Australia','AT' => 'Austria','AZ' => 'Azerbaiyán',
    'BS' => 'Bahamas','BH' => 'Bahréin','BD' => 'Bangladesh','BB' => 'Barbados','BE' => 'Bélgica','BZ' => 'Belice','BJ' => 'Benín','BY' => 'Bielorrusia',
    'MM' => 'Birmania','BO' => 'Bolivia','BA' => 'Bosnia y Herzegovina','BW' => 'Botsuana','BR' => 'Brasil','BN' => 'Brunéi','BG' => 'Bulgaria','BF' => 'Burkina Faso','BI' => 'Burundi',
    'CV' => 'Cabo Verde','KH' => 'Camboya','CM' => 'Camerún','CA' => 'Canadá','TD' => 'Chad','CL' => 'Chile','CN' => 'China','CY' => 'Chipre','CO' => 'Colombia',
    'KM' => 'Comoras','CG' => 'Congo','KP' => 'Corea del Norte','KR' => 'Corea del Sur','CI' => 'Costa de Marfil','CR' => 'Costa Rica','HR' => 'Croacia','CU' => 'Cuba',
    'DK' => 'Dinamarca','DM' => 'Dominica','DO' => 'República Dominicana',
    'EC' => 'Ecuador','EG' => 'Egipto','SV' => 'El Salvador','AE' => 'Emiratos Árabes Unidos','ER' => 'Eritrea','SK' => 'Eslovaquia','SI' => 'Eslovenia','ES' => 'España',
    'US' => 'Estados Unidos','EE' => 'Estonia','SZ' => 'Esuatini','ET' => 'Etiopía',
    'PH' => 'Filipinas','FI' => 'Finlandia','FJ' => 'Fiyi','FR' => 'Francia',
    'GA' => 'Gabón','GM' => 'Gambia','GE' => 'Georgia','GH' => 'Ghana','GD' => 'Granada','GR' => 'Grecia','GT' => 'Guatemala','GN' => 'Guinea',
    'GW' => 'Guinea-Bisáu','GQ' => 'Guinea Ecuatorial','GY' => 'Guyana',
    'HT' => 'Haití','HN' => 'Honduras','HU' => 'Hungría',
    'IN' => 'India','ID' => 'Indonesia','IQ' => 'Irak','IR' => 'Irán','IE' => 'Irlanda','IS' => 'Islandia','MH' => 'Islas Marshall','SB' => 'Islas Salomón','IL' => 'Israel','IT' => 'Italia',
    'JM' => 'Jamaica','JP' => 'Japón','JO' => 'Jordania',
    'KZ' => 'Kazajistán','KE' => 'Kenia','KG' => 'Kirguistán','KI' => 'Kiribati','KW' => 'Kuwait',
    'LA' => 'Laos','LS' => 'Lesoto','LV' => 'Letonia','LB' => 'Líbano','LR' => 'Liberia','LY' => 'Libia','LI' => 'Liechtenstein','LT' => 'Lituania','LU' => 'Luxemburgo',
    'MG' => 'Madagascar','MY' => 'Malasia','MW' => 'Malaui','MV' => 'Maldivas','ML' => 'Malí','MT' => 'Malta','MA' => 'Marruecos','MU' => 'Mauricio','MR' => 'Mauritania','MX' => 'México',
    'FM' => 'Micronesia','MD' => 'Moldavia','MC' => 'Mónaco','MN' => 'Mongolia','ME' => 'Montenegro','MZ' => 'Mozambique',
    'NA' => 'Namibia','NR' => 'Nauru','NP' => 'Nepal','NI' => 'Nicaragua','NE' => 'Níger','NG' => 'Nigeria','NO' => 'Noruega','NZ' => 'Nueva Zelanda',
    'OM' => 'Omán',
    'NL' => 'Países Bajos','PK' => 'Pakistán','PW' => 'Palaos','PA' => 'Panamá','PG' => 'Papúa Nueva Guinea','PY' => 'Paraguay','PE' => 'Perú','PL' => 'Polonia','PT' => 'Portugal',
    'QA' => 'Qatar',
    'RO' => 'Rumanía','RU' => 'Rusia','RW' => 'Ruanda',
    'KN' => 'San Cristóbal y Nieves','SM' => 'San Marino','VC' => 'San Vicente y las Granadinas','LC' => 'Santa Lucía','WS' => 'Samoa','PM' => 'San Pedro y Miquelón','ST' => 'Santo Tomé y Príncipe','SN' => 'Senegal','RS' => 'Serbia','SC' => 'Seychelles','SL' => 'Sierra Leona','SG' => 'Singapur','SY' => 'Siria','SO' => 'Somalia','LK' => 'Sri Lanka','SZ' => 'Suazilandia','ZA' => 'Sudáfrica','SD' => 'Sudán','SS' => 'Sudán del Sur','SE' => 'Suecia','CH' => 'Suiza','SR' => 'Surinam',
    'TH' => 'Tailandia','TZ' => 'Tanzania','TJ' => 'Tayikistán','TL' => 'Timor Oriental','TG' => 'Togo','TO' => 'Tonga','TT' => 'Trinidad y Tobago','TN' => 'Túnez',
    'UA' => 'Ucrania','UG' => 'Uganda','UY' => 'Uruguay','UZ' => 'Uzbekistán',
    'VU' => 'Vanuatu','VA' => 'Vaticano','VE' => 'Venezuela','VN' => 'Vietnam',
    'YE' => 'Yemen',
    'ZM' => 'Zambia','ZW' => 'Zimbabue',
];

// Función para generar emoji de bandera desde código ISO
function country_flag($code) {
    return mb_convert_encoding('&#'.(127397 + ord($code[0])).';','UTF-8','HTML-ENTITIES') .
           mb_convert_encoding('&#'.(127397 + ord($code[1])).';','UTF-8','HTML-ENTITIES');
}

// Ordenar y agrupar
asort($countries);
$grouped = [];
foreach ($countries as $code => $country) {
    $letter = mb_substr($country, 0, 1);
    $grouped[$letter][$code] = $country;
}
@endphp

<select id="pais" name="pais" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    <option value="">{{ __('Selecciona tu país') }}</option>
    @foreach($grouped as $letter => $countriesByLetter)
        <optgroup label="{{ $letter }}">
            @foreach($countriesByLetter as $code => $country)
                <option value="{{ $country }}" {{ (old('pais', $user->pais ?? '') == $country) ? 'selected' : '' }}>
                    {{-- {!! country_flag($code) !!}--}} {{ $country }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>
