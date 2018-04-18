<!DOCTYPE html>
<html>
    <head>
        <title>Email Notification</title>
    </head>
    
    <body>
        <table class="wrapper" style="border-collapse: collapse;table-layout: fixed;min-width: 320px;width: 100%;background-color: #f0f0f0;"
            cellpadding="0" cellspacing="0" role="presentation">
            <tbody>
                <tr>
                    <td>
                        <div role="banner">
                            <div class="preheader" style="Margin: 0 auto;max-width: 560px;min-width: 280px; width: 280px;width: calc(28000% - 167440px);">
                                <div style="border-collapse: collapse;display: table;width: 100%;">
                                    <div class="snippet" style="display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 140px; width: 140px;width: calc(14000% - 78120px);padding: 10px 0 5px 0;color: #bdbdbd;font-family: Ubuntu,sans-serif;">
                                    </div>
                                    <div class="webversion" style="display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 139px; width: 139px;width: calc(14100% - 78680px);padding: 10px 0 5px 0;text-align: right;color: #bdbdbd;font-family: Ubuntu,sans-serif;">
    
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <div role="section">
                            <div class="layout one-col fixed-width" style="Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">
                                <div class="layout__inner" style="border-collapse: collapse;display: table;width: 100%;background-color: #ffffff;" emb-background-style="">
                                    <div class="column" style="text-align: left;color: #787778;font-size: 16px;line-height: 24px;font-family: Ubuntu,sans-serif;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);">
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;Margin-top: 24px;">
                                            <div style="line-height: 20px;font-size: 1px;">&nbsp;</div>
                                        </div>
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;">
                                            <div>
                                                <h1 style="Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #565656;font-size: 30px;line-height: 38px;text-align: center;">
                                                    <strong>{{$reminder->title}}</strong>
                                                </h1>
                                                <p style="Margin-top: 20px;Margin-bottom: 0;">&nbsp;
                                                    <br> This is a notification email to remember you the next:</p>
                                                @if ($reminder->description)
                                                    <p style="Margin-top: 20px;Margin-bottom: 20px;">Reminder: {{$reminder->description}}</p>
                                                @endif

                                                @if ($reminder->isPayment == 1)
                                                    <p style="Margin-top: 20px;Margin-bottom: 20px;">You have to pay: {{$reminder->amount}}</p>
                                                @endif
                                                
                                            </div>
                                        </div>
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;">
                                            <div style="line-height: 10px;font-size: 1px;">&nbsp;</div>
                                        </div>
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;">
                                            @if ($reminder->location)
                                                <div class="btn btn--shadow btn--large" style="Margin-bottom: 20px;text-align: center;">
                                                    <p style="Margin-top: 20px;Margin-bottom: 20px;">You have to go to: {{$reminder->location}}</p>
                                                    <a style="border-radius: 4px;display: inline-block;font-size: 14px;font-weight: bold;line-height: 24px;padding: 12px 24px 13px 24px;text-align: center;text-decoration: none !important;transition: opacity 0.1s ease-in;color: #ffffff !important;box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.2);background-color: #80bf2e;font-family: Ubuntu, sans-serif;"
                                                    href="{{ $reminder->urlLoc }}" target="_blank">Check Google Maps</a>
                                                </div>
                                            @endif
                                        </div>
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;">
                                            <div style="line-height: 10px;font-size: 1px;">&nbsp;</div>
                                        </div>
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;">
                                            <div>
                                                @if ($reminder->contact)
                                                    <p style="Margin-top: 20px;Margin-bottom: 20px;">Contact number: {{$reminder->contact}}</p>
                                                @endif
                                            </div>
                                        </div>
    
                                        <div style="Margin-left: 20px;Margin-right: 20px;Margin-bottom: 24px;">
                                            <div style="line-height: 5px;font-size: 1px;">&nbsp;</div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
    
                            <div style="line-height: 10px;font-size: 10px;">&nbsp;</div>
    
    
                            <div role="contentinfo">
                                <div class="layout email-footer" style="Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;">
                                    <div class="layout__inner" style="border-collapse: collapse;display: table;width: 100%;">
                                        <div class="column wide" style="text-align: left;font-size: 12px;line-height: 19px;color: #bdbdbd;font-family: Ubuntu,sans-serif;Float: left;max-width: 400px;min-width: 320px; width: 320px;width: calc(8000% - 47600px);">
                                            <div style="Margin-left: 20px;Margin-right: 20px;Margin-top: 10px;Margin-bottom: 10px;">
                                                <table class="email-footer__links emb-web-links" style="border-collapse: collapse;table-layout: fixed;" role="presentation">
                                                    <tbody>
                                                        <tr role="navigation">
                                                            <td class="emb-web-links" style="padding: 0;width: 26px;">
                                                                <a style="text-decoration: underline;transition: opacity 0.1s ease-in;color: #bdbdbd;" href="http://facebook.com" target="_blank">
                                                                    <img style="border: 0;" src="https://i2.createsend1.com/static/eb/master/13-the-blueprint-3/images/facebook.png" width="26"
                                                                        height="26" alt="Facebook">
                                                                </a>
                                                            </td>
                                                            <td class="emb-web-links" style="padding: 0 0 0 3px;width: 26px;">
                                                                <a style="text-decoration: underline;transition: opacity 0.1s ease-in;color: #bdbdbd;" href="http://facebook.com" target="_blank">
                                                                    <img style="border: 0;" src="https://i3.createsend1.com/static/eb/master/13-the-blueprint-3/images/twitter.png" width="26"
                                                                        height="26" alt="Twitter">
                                                                </a>
                                                            </td>
                                                            <td class="emb-web-links" style="padding: 0 0 0 3px;width: 26px;">
                                                                <a style="text-decoration: underline;transition: opacity 0.1s ease-in;color: #bdbdbd;" href="http://facebook.com" target="_blank">
                                                                    <img style="border: 0;" src="https://i6.createsend1.com/static/eb/master/13-the-blueprint-3/images/linkedin.png" width="26"
                                                                        height="26" alt="LinkedIn">
                                                                </a>
                                                            </td>
                                                            <td class="emb-web-links" style="padding: 0 0 0 3px;width: 26px;">
                                                                <a style="text-decoration: underline;transition: opacity 0.1s ease-in;color: #bdbdbd;" href="http://facebook.com" target="_blank">
                                                                    <img style="border: 0;" src="https://i7.createsend1.com/static/eb/master/13-the-blueprint-3/images/website.png" width="26"
                                                                        height="26" alt="Website">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div style="font-size: 12px;line-height: 19px;Margin-top: 20px;">
                                                    <div>Agenda made it with Laravel</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="line-height: 40px;font-size: 40px;">&nbsp;</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>