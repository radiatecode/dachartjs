<?php


namespace RadiateCode\DaChart\Enums;


class GeneralOption
{
    const OPTIONS
        = [
            /**
             * Chart responsive options
             */
            'responsive'          => true,
            'maintainAspectRatio' => true,
            'aspectRatio' => 2,

            /**
             * Interaction options
             */
            'interaction'         => [
                // if true, the interaction mode only applies when the mouse position intersects an item on the chart.
                'intersect' => false,

                // Sets which elements appear in the interaction
                'mode'      => 'index', // point, nearest, index, dataset, x, y,

                // Can be set to 'x', 'y', or 'xy' to define which directions are used in calculating distances.
                // Defaults to 'x' for 'index' mode and 'xy' in dataset and 'nearest' modes.
                'axis' => 'x'
            ],

            /**
             * Tooltip options
             */
            'tooltips'            => [
                // Sets which elements appear in the tooltip
                'mode'            => 'index',
                // If true, the tooltip mode applies only when the mouse position intersects with an element. If false, the mode will be applied at all times.
                'intersect'       => false,
                // The mode for positioning the tooltip
                'position'        => 'nearest',
                'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                'titleColor'      => '#fff',
                'titleAlign'      => 'left',
                'borderColor'     => 'rgba(0, 0, 0, 0)',
                'borderWidth'     => 0,
            ],

            /**
             * Plugins
             */
            'plugins'             => [
                /**
                 * The chart legend displays data about the datasets that are appearing on the chart
                 */
                'legend' => [
                    'display'  => true,
                    'position' => 'top',
                    'align' => 'center'
                ],

                /**
                 * The chart title defines text to draw at the top of the chart
                 */
                'title'  => [
                    'align' => 'center',
                    'text'     => 'My Chart',
                    'position' => 'top',
                    'display'  => true,
                    'color'    => 'black',
                ],
            ],
        ];
}