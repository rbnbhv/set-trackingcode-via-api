# Trackingcode & Bestell-Status per Shopware 6 API setzen
- Über die Shopware 6 API soll an eine bestehende Bestellung deiner Wahl ein beliebiger Trackingcode und der Bestellstatus „shipped“ gesetzt werden, dafür muss über eine externe Anwendung (z.B. Postman, PHP, Phyton) eine Verbindung zum Shop hergestellt werden.

- Die Doku zur Shopware API: https://shopware.stoplight.io/docs/admin-api/adminapi.json
- Shop Frontend: http://shopware.p574147.webspaceconfig.de

### ToDo
1. [ ] Einloggen als Administrator
2. [ ] Bestellung laden (über UUID)
3. [ ] Trackingcode setzen
  4. [ ] Bestellung bearbeiten
  5. [ ] API Request senden an: http://shopware.p574147.webspaceconfig.de/api/order/6e96bb30203e4355b6a10caeec40c1b3
     - Als ```PATCH``` Request
     - Mit dem Payload: 
     {"id":"6e96bb30203e4355b6a10caeec40c1b3","versionId":"a5910bf677f74acf8c364244501ae27c","orderCustomer":{"id":"40f1d714a7ad400095f3bdd3539745aa","versionId":"a5910bf677f74acf8c364244501ae27c","remoteAddress":null},"deliveries":[{"id":"2f41a90c2fe943f6829cab2e8d6e0b42","versionId":"a5910bf677f74acf8c364244501ae27c","trackingCodes":["512525252"]}]} 
     - Trackingcode einfügen
     - Versendungsstatus auf shipped setzen