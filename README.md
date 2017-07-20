puttyreg2sshconfig
==============================

Usage
-----

Export the following path in regedit and make sure the reg file is UTF-8 encoded:
[HKEY_CURRENT_USER\Software\Simontatham\PuTTY\Sessions]



    $ chmod u+x convert.php
    $ cat putty.reg | ./convert.php > ~/.ssh/config
