//
//  AppDelegate.swift
//  With_GYM
//
//  Created by 김용우 on 2017. 11. 8..
//  Copyright © 2017년 김용우. All rights reserved.
//

import UIKit

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {

    var window: UIWindow?
    var pref = UserDefaults.standard

    func application(_ application: UIApplication, didFinishLaunchingWithOptions
        launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {
        
        NSLog("=====app Start=====")
        let applyComplete = pref.bool(forKey: "applyComplete")
        NSLog("applyComplete = \(applyComplete)")

        if applyComplete == true {
            apply = applyComplete
            personalInformation[0] = pref.string(forKey: "infoName")!
            personalInformation[1] = pref.string(forKey: "infoJob")!
            personalInformation[2] = pref.string(forKey: "infoMajor")!
            personalInformation[3] = pref.string(forKey: "infoNumber")!
            personalInformation[4] = pref.string(forKey: "infoPhone")!
            personalInformation[5] = pref.string(forKey: "infoPeriod")!
            
            NSLog("접수 완료상태")
        } else {
            NSLog("접수 미완료상태")
        }
        return true
    }

    func applicationWillResignActive(_ application: UIApplication) {
        // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
        // Use this method to pause ongoing tasks, disable timers, and invalidate graphics rendering callbacks. Games should use this method to pause the game.
    }

    func applicationDidEnterBackground(_ application: UIApplication) {
        // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
        // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
    }

    func applicationWillEnterForeground(_ application: UIApplication) {
        // Called as part of the transition from the background to the active state; here you can undo many of the changes made on entering the background.
    }

    func applicationDidBecomeActive(_ application: UIApplication) {
        // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
    }

    func applicationWillTerminate(_ application: UIApplication) {
        // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
        NSLog("=====app WillTerminate=====")
        pref.set(apply, forKey: "applyComplete")
        
        if apply == true {
            pref.set(personalInformation[0], forKey: "infoName")
            pref.set(personalInformation[1], forKey: "infoJob")
            pref.set(personalInformation[2], forKey: "infoMajor")
            pref.set(personalInformation[3], forKey: "infoNumber")
            pref.set(personalInformation[4], forKey: "infoPhone")
            pref.set(personalInformation[5], forKey: "infoPeriod")
            NSLog("회원접수 신청완료, 회원정보 저장")
        } else {
            NSLog("회원접수 미신청")
        }
    }


}

