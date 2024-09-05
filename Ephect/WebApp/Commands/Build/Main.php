<?php

namespace Ephect\WebApp\Commands\Build;

use Ephect\Framework\Commands\AbstractCommand;
use Ephect\Framework\Commands\Attributes\CommandDeclaration;

#[CommandDeclaration(verb: "build")]
#[CommandDeclaration(desc: "Build the application.")]
class Main extends AbstractCommand
{
    public function run(): int
    {

        $logo2 = <<< LOGO
╔══════════════════════════════════════════════════════════════════════════════╗
║██╗   ██╗███████╗███████╗    ███████╗██████╗ ██╗  ██╗███████╗ ██████╗████████╗║
║██║   ██║██╔════╝██╔════╝    ██╔════╝██╔══██╗██║  ██║██╔════╝██╔════╝╚══██╔══╝║
║██║   ██║███████╗█████╗      █████╗  ██████╔╝███████║█████╗  ██║        ██║   ║
║██║   ██║╚════██║██╔══╝      ██╔══╝  ██╔═══╝ ██╔══██║██╔══╝  ██║        ██║   ║
║╚██████╔╝███████║███████╗    ███████╗██║     ██║  ██║███████╗╚██████╗   ██║   ║
║ ╚═════╝ ╚══════╝╚══════╝    ╚══════╝╚═╝     ╚═╝  ╚═╝╚══════╝ ╚═════╝   ╚═╝   ║
╚══════════════════════════════════════════════════════════════════════════════╝

LOGO;
        $logo3 = <<< LOGO
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@. @ .@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @==*##@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@  %=====*#####%  @@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@ :#=======+#########%: @@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@ +*=======+%: @ :%#########* @@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@* #+=======*@ .@*         *@%#####% *@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@- %+=======*@   =*========*####%# .@####% -@@@@@@@@@@@@@@@
@@@@@@@@@@@@  @========*@   *=====+**#############%* @####@  @@@@@@@@@@@@
@@@@@@@@@  @========#@ @ #====*######################@ @#####@  @@@@@@@@@
@@@@@@@@ =======+## @@ *===*###########################@ @###### @@@@@@@@
@@@@@@@@ +++=+%= @@@% ===*##########@*-.-+@%######*######+*##### @@@@@@@@
@@@@@@@@ ++++# @@@@=+==+#######%+ @@@@@@@@@@@ -%##########@.#### @@@@@@@@
@@@@@@@@ ++++# @@@=*==+####*#@ %@@@@@@@@@@@@@@@@ @#*###**##@ @## @@@@@@@@
@@@@@@@@ ++++# @@@-==+######=*@@@@@@@@@@@@@@@@@@@% @##*#@: @#### @@@@@@@@
@@@@@@@@ ++++# @@ +==###### @@@@@- =+  @@@@@@@@@@@@@@@%@@@ ##### @@@@@@@@
@@@@@@@@ ++++# @@===**#**#+@@@@ @*====+++ @@@@@@@@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ ++++# @ *==*#***% @@@ *####*====*#= +*#:@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ ++++# @ +=+*****@+@@ +*. @*###+======+-@@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ +++=# @ +=+*****@+@@  %@@@-.*####***#%-@@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ +==+# @ *==*****% @@@@@@@@@@% %%*#+% @@@@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ ++++# @@*==******:@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ +=++# @@ ==+*****# @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ ##### @@@@@@@@
@@@@@@@@ +===# @@#===*****+= @@@@@@@@@@@@@@@@@@@@@ +#@%@   ##### @@@@@@@@
@@@@@@@@ ==+=# @@@ *==*****==* @@@@@@@@@@@@@@@@@ #==********#### @@@@@@@@
@@@@@@@@ ====# @@@@ @********==*  @@@@@@@@@@@= *==**********#### @@@@@@@@
@@@@@@@@ ===+*@ -@@@+**********+==+*-     :*+==+********#*+##### @@@@@@@@
@@@@@@@@ +*******%  @@ @***********++=====++*********#*+######## @@@@@@@@
@@@@@@@@@ +#********%= @ @************************#+*########%+ %@@@@@@@@
@@@@@@@@@@@@  %********##  ##******************#+*########%  @@@@@@@@@@@@
@@@@@@@@@@@@@@@  %********#@   @#***********#=*########@  @@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@  @*********@ %@     :: @*########@  @@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@- @#********@ =@= @#########@ :@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@# %#********%#########% *@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@% *#*****######%* %@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ :%**###%- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

LOGO;


        echo $logo3 . PHP_EOL;


        $egg = new Lib($this->application);
        $egg->build();

        return 0;
    }
}
