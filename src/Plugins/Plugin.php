<?php


namespace RadiateCode\DaChart\Plugins;


class Plugin
{
    /**
     * @return string
     */
    public function pluginLibraries()
    {
        return "<script src='https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.1.0/chartjs-plugin-annotation.min.js'></script>";
    }

    public function pluginRegisterName(){
        return '';
    }

    public function pluginOptions(){
        return "{ 
                autocolors: false,
                annotation: {
                  annotations: {
                    box1: {
                      drawTime: 'afterDatasetsDraw',
                      display: (context, opts) => {
                        const body = document.querySelector('body');
                        const rect = body.getBoundingClientRect();
                        return rect.width >= 1000;
                      },
                      type: 'box',
                      xMin: 1,
                      xMax: 2,
                      yMin: 50,
                      yMax: 70,
                      backgroundColor: 'rgba(255, 99, 132, 0.5)'
                    }
                  }
                }
              }";
    }
}