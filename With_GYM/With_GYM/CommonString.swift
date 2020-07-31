//
//  CommonString.swift
//  With_GYM
//
//  Created by 김용우 on 2017. 11. 12..
//  Copyright © 2017년 김용우. All rights reserved.
//

import Foundation

class CommonString {
    public static var appVersion = "0.1"    //앱버전에 따라 수정
    
    public static let baseURL         = "http://119.204.195.207:2571/app/"
    //public static let baseURL         = "http://127.0.0.1:8888/app/"
    
    public static var requestURL    = "\(baseURL)check_data.php"
    public static var sendURL       = "\(baseURL)apply.php"
    public static var editURL       = "\(baseURL)edit.php"
    public static var editReqURL    = "\(baseURL)edit_check_data.php"
    
    public static var deviceID = ""
    public static var deviceOS = "iOS"
    
    public static var requestFullURL = "\(requestURL)?SID=\(deviceID)&type=\(deviceOS)&version=\(appVersion)"
    public static var sendFullURL    = "\(sendURL)?SID=\(deviceID)&type=\(deviceOS)&version=\(appVersion)"
    public static var editFullURL    = "\(editURL)?SID=\(deviceID)&type=\(deviceOS)&version=\(appVersion)"
    public static var editReqFullURL = "\(editReqURL)?SID=\(deviceID)&type=\(deviceOS)&version=\(appVersion)"
}
