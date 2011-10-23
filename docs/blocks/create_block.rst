.. Casemate documentation master file, created by
   sphinx-quickstart on Sun Oct 23 18:25:35 2011.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.


How to add another Block ?
==========================

Casemate is built with extensibility in mind.

It's not intended to fit all requirements with the few blocks it provides.
That's why it proposes an easy way to create you own block bundles.

    ./app/console generate:block:bundle --bundle-name="TestBlockBundle" --namespace="Acme\\Bundle\\TestBlockBundle" --dir="./src"

This command will build a ready to go ``TestBlockBundle`` in the ``src/Acme/Bundle/TestBlockBundle`` directory.

You'll than have to edit the ``TectBlockController`` and the ``Document\TestBlock`` classes to fit your needs.
