<?php


namespace RadiateCode\DaChart\Enums;


class ChartColor
{
    const WILD_WATERMELON = "rgba(255, 99, 132, 0.8)";
    const SUMMER_SKY = "rgba(255, 99, 132, 0.8)";
    const MUSTARD = "rgba(255, 99, 132, 0.8)";
    const VIKING = "rgba(75, 192, 192, 0.8)";
    const LIGHT_SLATE_BLUE = "rgba(153, 102, 255, 0.8)";
    const INCH_WORM = "rgba(159, 237, 57, 0.8)";
    const MEDIUM_RED_VIOLET = "rgba(179, 36, 156, 0.8)";
    const CINNABAR = "rgba(241, 78, 45, 0.8)";
    const YELLOW_ORANGE = "rgba(255, 159, 64, 0.8)";
    const JADE = "rgba(7, 183, 109, 0.8)";
    const EGGPLANT = "rgba(137, 5, 80, 0.8)";
    const RAZZMATAZZ = "rgba(211, 8, 110, 0.8)";
    const DEEP_PINK = "rgba(242, 9, 133, 0.8)";
    const BRIGHT_TURQUOISE = "rgba(9, 247, 227, 0.8)";
    const ELECTRIC_PURPLE = "rgba(157, 9, 259, 0.8)";
    const CARIBBEAN_GREEN = "rgba(8, 221, 165, 0.8)";
    const BONDI_BLUE = "rgba(7, 139, 191, 0.8)";
    const SHERPA_BLUE = "rgba(3, 67, 86, 0.8)";
    const SPRING_BUD = "rgba(146, 237, 9, 0.8)";
    const MAROON = "rgba(84, 22, 3, 0.8)";

    const COLORS
        = [
            self::WILD_WATERMELON,
            self::SUMMER_SKY,
            self::MUSTARD,
            self::VIKING,
            self::LIGHT_SLATE_BLUE,
            self::INCH_WORM,
            self::MEDIUM_RED_VIOLET,
            self::CINNABAR,
            self::YELLOW_ORANGE,
            self::JADE,
            self::EGGPLANT,
            self::RAZZMATAZZ,
            self::DEEP_PINK,
            self::BRIGHT_TURQUOISE,
            self::ELECTRIC_PURPLE,
            self::CARIBBEAN_GREEN,
            self::BONDI_BLUE,
            self::SHERPA_BLUE,
            self::SPRING_BUD,
            self::MAROON
        ];

    /**
     * @param  int  $number // Specifies how many random keys to return
     *
     * @return array|string
     */
    public static function randColor(int $number = 1)
    {
        $randKeys = array_rand(self::COLORS,$number);

        if (is_array($randKeys)){
            $colors = [];

            foreach ($randKeys as $key){
                $colors[] = self::COLORS[$key];
            }

            return $colors;
        }

        return self::COLORS[$randKeys];
    }

}