<?php

namespace Ephect\Commands\Build;

use Ephect\Framework\CLI\Console;
use Ephect\Framework\Commands\AbstractCommand;
use Ephect\Framework\Commands\Attributes\CommandDeclaration;

#[CommandDeclaration(verb: "build")]
#[CommandDeclaration(desc: "Build the application.")]
class Main extends AbstractCommand
{
    public function run(): int
    {
        $logo = <<< LOGO
                       vv                       
                    vvvvvvvv                    
                ccvvvvcccvcvcccc                
             ccccccc xxxxxxxxxxxxxc             
          zzzzzzznxnxxxnnxxnnnnxxnxxxx          
       zzzzzzz nnnnnnnnnnnnnnnnnnnnnnnnnz       
    XXXXXXX  vvvvvvvvvvvvvvvvvvvvvvvvvvvvvXX    
   YXXXY    cccccccccccccccccccccccccccccccXY   
   YYYY    ccccccccccc           cccccczccccY   
   JJJJ   zzzzzzzzzz               zzzzzzzzJJ   
   CJJJ  XXXXXXXXXX     XX               JJJJ   
   CCCC  YYYYYYYYY   YYYYYYYY     Y      CCCC   
   QCCC  YYYYYYYYJ  Y   YYYYYYYYYY       CCCQ   
   QQQQ  JJJJJJJJJ        JJJJJJJ        QQQQ   
   000Q  CCCCCCCCC                       00Q0   
   O000  QQQCQCQCQQ                      0000   
   OOOO   QQQ0QQ0Q0Q               QQQQQQ00OO   
   ZOOO    00000000000           00000000000Z   
   ZZZZm    OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOZZ   
    mZmmmmm  ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZmm    
       mmmmmmm ZZZZZZZZZZZZZZZZZZZZZZZZZm       
          wwwwwwwmmmmmmmmmmmmmmmmmmmmm          
             pwwwwww wwwwwwwwwwwwwp             
                pppppppbdppppppp                
                    pdpppppp                    
                       dd  
LOGO;

        $logo2 = <<< LOGO
                                                                                          
                                                                                          
                                                                                          
LOGO;

        echo $logo2 . PHP_EOL;


        $egg = new Lib($this->application);
        $egg->build();

        return 0;
    }
}
