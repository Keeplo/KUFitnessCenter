//
//  ViewController.swift
//  With_GYM
//
//  Created by 김용우 on 2017. 11. 8..
//  Copyright © 2017년 김용우. All rights reserved.
//

import UIKit

var personalInformation:[String] = ["","","","","",""]
var apply = false

class ViewController: UIViewController, UIWebViewDelegate {

    @IBOutlet weak var currentStateLbl: UILabel!
    @IBOutlet weak var memberStateLbl: UILabel!
    @IBOutlet weak var latelyDateLbl: UILabel!
    @IBOutlet weak var latelyDateTitleLbl: UILabel!
    @IBOutlet weak var nameLbl: UILabel!
    
    @IBOutlet weak var receiptBtn: UIButton!
    @IBOutlet weak var editBtn: UIButton!
    
    //@IBOutlet weak var webViewIndicator: UIActivityIndicatorView!
    
    @IBOutlet weak var subWebView: UIWebView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        NSLog("----------viewDidLoad----------")
        
        let uuid = UIDevice.current.identifierForVendor
        CommonString.deviceID = String(describing: uuid!)
        
        //webViewIndicator.isHidden = true
        subWebView.delegate = self
        
        receiptBtn.layer.cornerRadius = 10.0
        editBtn.layer.cornerRadius    = 10.0
        
        let tap = UITapGestureRecognizer(target: self, action: #selector(tapGesture))
        nameLbl.isUserInteractionEnabled = true
        nameLbl.addGestureRecognizer(tap)
        
        //데이터 체크
        NSLog("데이터 체크")
        
        //스마트폰 접수상태정보
        if apply == true {
            receiptBtn.isEnabled = false
            editBtn.isEnabled    = false
            editBtn.isHidden     = true
        } else {
            receiptBtn.isEnabled = true
            editBtn.isEnabled    = false
            editBtn.isHidden     = true
        }
    }
    override func viewDidAppear(_ animated: Bool) {
        super.viewDidAppear(true)
        NSLog("----------viewDidApper----------")
        //현재 DB상태 확인
        currentStateReq()
    }
    @objc func tapGesture(sender:UITapGestureRecognizer) {
        print("정보 새로고침")
        currentStateReq()
    }
    //MARK: --------------------------------------- Button Action
    
    
    
    //MARK: --------------------------------------- WebView Method
    func currentStateReq() {
        let url = "\(CommonString.requestFullURL)"
        NSLog(url)
        subWebView?.loadRequest(URLRequest(url: URL(string: url)!))
    }
    func webView(_ webView: UIWebView, shouldStartLoadWith request: URLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        NSLog("JS -> 아이폰")
        if let s = request.url?.absoluteString {
            if s.hasPrefix("js:"){
                var array = s.components(separatedBy: "://")
                let customFunction = array[1] // array[0] value is 'js'
                let list = customFunction.components(separatedBy: "?")
                let funcName = String(describing: list[0])
                let current  = String(describing: list[1]) + " 명"
                var lately   = "dump"
                var name     = "dump"
                var total    = "dump"
                if funcName == "noMember" {
                    total    = String(describing: list[2]) + " 명"
                } else {
                    lately   = String(describing: list[2]).removingPercentEncoding!
                    name     = String(describing: list[3]).removingPercentEncoding! + " 회원님"
                }
                NSLog("DB Request Data [" + funcName + ", " + current + ", " + lately + ", " + name + "]")
                switch(funcName){
                case "applyComplete" :
                    applyComplete(current, name)
                    break
                case "applyRequest" :
                    applyRequest(current, name)
                    break
                case "paymentWait" :
                    paymentWait(current, name)
                    break
                case "paymentDone" :
                    paymentDone(current, lately, name)
                    break
                case "noMember"  :
                    non_dataState(current, total)
                    break
                default:
                    break
                }
                return false
            }
        }
        return true
    }
    //상태확인
    func non_dataState(_ current:String, _ total:String) {
        let msg = "미 접수 상태"
        NSLog(msg)
        
        //하단 버튼 구별, 상단라벨
        changeBtn(true, false, false, true)
        changeLbl("", current, msg, "", total)
    }
    func applyComplete(_ current:String, _ name:String) {
        let msg = "접수완료 상태"
        NSLog(msg)
       
        changeBtn(false, false, false, true)
        changeLbl(name, current, msg, "", "")
    }
    func applyRequest(_ current:String, _ name:String) {
        let msg = "정보수정 요청상태"
        NSLog(msg)
        
        changeBtn(false, true, true, false)
        changeLbl(name, current, msg, "", "")
    }
    func paymentWait(_ current:String, _ name:String) {
        let msg = "결제대기 상태"
        NSLog(msg)
        
        changeBtn(false, false, false, true)
        changeLbl(name, current, msg, "", "등록비용 입금 계좌번호")
    }
    func paymentDone(_ current:String, _ lately:String, _ name:String) {
        let msg = "회원등록 완료상태"
        NSLog(msg)
        
        changeBtn(false, true, false, true)
        changeLbl(name, current, msg, lately, "")
    }
    
    
    //버튼 상태, 라벨 상태 변환기
    func changeBtn(_ isE1:Bool, _ isH1:Bool, _ isE2:Bool, _ isH2:Bool) {
        receiptBtn.isEnabled = isE1
        receiptBtn.isHidden  = isH1
        editBtn.isEnabled    = isE2
        editBtn.isHidden     = isH2
    }
    func changeLbl(_ name:String, _ current:String, _ member:String, _ lately:String, _ total:String) {
        if lately == "" {
            if total == "" {
                nameLbl.text         = name
                currentStateLbl.text = current
                memberStateLbl.text  = member
                
                latelyDateLbl.isHidden      = true
                latelyDateTitleLbl.isHidden = true
                
                latelyDateTitleLbl.text = "최근 방문 일시"
            } else if total == "등록비용 입금 계좌번호" {
                nameLbl.text         = name
                currentStateLbl.text = current
                memberStateLbl.text  = member
                
                latelyDateLbl.isHidden      = false
                latelyDateTitleLbl.isHidden = false
                
                latelyDateLbl.text      = "신X은행 111-22-333333 건국대"
                latelyDateTitleLbl.text = total
            } else {
                nameLbl.text         = name
                currentStateLbl.text = current
                memberStateLbl.text  = member
                
                latelyDateLbl.isHidden      = false
                latelyDateTitleLbl.isHidden = false
                
                latelyDateLbl.text      = total
                latelyDateTitleLbl.text = "센터회원 전체인원"
            }
        } else {
            NSLog("방문일시")
            nameLbl.text         = name
            currentStateLbl.text = current
            memberStateLbl.text  = member
            
            latelyDateLbl.isHidden   = false
            latelyDateTitleLbl.isHidden = false
            
            latelyDateLbl.text = lately
            latelyDateTitleLbl.text = "최근 방문 일시"
        }
    }
}

